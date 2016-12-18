# Event Plugins

The default implementation of the `Session` interface is `NativeSession`. This class has a second argument in its constructor which accepts an array of objects which extend the abstract `Plugin` class.

These plugins get notified when certain events occur. There are three concrete (but empty) methods in the `Plugin` class.

* `onStart`
* `onRegenerate`
* `onDestroy`

## Provided Plugins

We've shipped two plugins that you can use out of the box.

### Cross-site Request Forgery Token

The `CsrfPlugin` is responsible for generating a CSRF token for use in an application's form submissions.
You can retrieve the token to add to forms, and you can also test if a submitted token matches the generated one.

```php
$csrf = new \Caridea\Session\CsrfPlugin();
$session = new \Caridea\Session\NativeSession($_COOKIE, [$csrf]);

$token = $csrf->getValue();

if ($csrf->isValid($someToken)) {
    // valid CSRF token
}
```

### Flash Messages

The `FlashPlugin` is responsible for storing and retrieving one-time notifications to display to the user.
It has the concept of *current* messages, which should be displayed to the user on *this* request, as well as *next* messages, which should be displayed to the user on the *next* request.

```php
$flash = new \Caridea\Session\FlashPlugin();
$session = new \Caridea\Session\NativeSession($_COOKIE, [$flash]);

$bar = $flash->getCurrent('foo', 'the default');

foreach ($flash->getAllCurrent() as $name => $value) {
    echo "$name = $value", PHP_EOL;
}

$flash->set('foo', 'baz'); // this gets set in the "next" set
echo $flash->getNext('foo', 'buzz'); // baz

$flash->set('foo', 'nothing', true); // this gets set in both "current" and "next"
echo $flash->getNext('foo', 'buzz'); // nothing
echo $flash->getCurrent('foo', 'buzz'); // nothing

$flash->clear(); // this clears the "next" set
$flash->clear(true); // this clears both "current" and "next"

$flash->keep(); // this copies all values in "current" to the "next" set
```

As soon as the session resumes, the *next* set replaces the *current* set, and the *next* set is cleared.
