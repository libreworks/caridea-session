# Namespaced Values

A useful feature of the `Session` interface is that of namespaced value maps. Classes can store session values under their own namespace, so as not to collide with session values used by any other code.

## The Map interface

Calling the `getValues` method of an object that implements the `Session` interface must return an object which implements the `Map` interface.

```php
$session = new \Caridea\Session\NativeSession($_COOKIE);
$values = $session->getValues("my-namspace");
```

We ship two `Map` classes.

* The `Values` class, which takes care of starting or resuming sessions when needed
* The `NullMap` class, which is a no-op implementation

### PHP Interfaces

`Map` implements the handy PHP interfaces `Countable`, `ArrayAccess`, and `IteratorAggregate`, so you can use a `Map` almost exactly like you can use a PHP associative array.

```php
// Countable
$length = count($values);

// ArrayAccess
unset($values['foo']);
$values['bar'] = 'stuff';
echo isset($values['abc']) ? $values['abc'] : '(nothing)';

// IteratorAggregate
foreach ($values as $k => $v) {
    echo "Session value: $k => $v";
}
```

### Other methods

There are three additional methods defined on the `Map` interface.

* `clear` – Remove all values in this namespace
* `get` – Uses a default value if the key isn't in the map
* `merge` – Add all values in a provided `Map` to this one

```php
$values = $session->getValues('foo');
$values2 = $session->getValues('bar');

$username = $values->get("username", 'anonymous');
$values->merge($values2);
$values2->clear();
```

## The Values class

This implementation of the `Map` interface is very handy. It automatically starts or resumes the session when it needs to. This way, you don't incur the performance overhead of starting the session unless absolutely necessary!

The following methods will automatically *start* the session. (As you can see, these are both *write-only* methods).

* `merge`
* `offsetSet`

The following methods will automatically *resume* the session. If the session has never been started, there's no need to start it, since these operations would return nothing anyway.

* `clear`
* `count`
* `get`
* `getIterator`
* `offsetExists`
* `offsetGet`
* `offsetUnset`

Finally, there's a public method, `getNamespace`, which will return the namespace under which this Map of values is stored.
