# Session Abstraction

PHP already has robust capabilities for handling client sessions. With the release of PHP 5.4, the release of the `SessionHandlerInterface` saw the chance for developers to craft their own session handlers. Suddenly, anything was possible and you didn't *have* to depend on an extension for alternate session storage.

Yet, the built-in session management in PHP is rather simple. As-is, developers don't have a means to watch for session-related events. Also rather simple is the storage of session variables. Developers can use the super-global `$_SESSION` array to store key-value pairs, but there was no way to guarantee that libraries writing to the session values didn't clobber values the developer was storing.

This is where caridea-session comes in.

## The Session Interface

The `Session` interface is the real face of the caridea-session library. It allows you the ability to not only manage session state (like the PHP session functions *already* do), but it also handles the aforementioned problems: event publishing and value namespacing.

### State

The `isStarted` method returns whether a session is currently active. The `canResume` method returns whether a session had previously been active, and could be resumed. The default implementation of the `Session` interface, `NativeSession`, has a `resume` method which calls both `isStarted` and `canResume`. The following code will reliably start or resume a session.

```php
$session->resume() || $session->start();
```

In the default implementation, the `resume` method calls `start` under the hood, but only if the session has been started before (that is, if the user supplies a session cookie).

### Actions

Once a session is started, you can call the `destroy` method to end it. You can also call `regenerateId` if you need to do that.

### Values

You can call the `getValues` method with a namespace argument to get a `Map` of values. See [the values documentation](values.md) for more information. You can also call the `clear` method to remove all currently set values.

## `NativeSession`

This class uses PHP's native session functions under the hood. To create a new one, you need at least one argument: the cookies array.

```php
$session = new \Caridea\Session\NativeSession($_COOKIE);
```

The second (optional) argument is a list of any session plugins you wish to register. See [the plugins documentation](plugins.md) for more information.

```php
$plugins = [new \Caridea\Session\CsrfPlugin()];
$session = new \Caridea\Session\NativeSession($_COOKIE, $plugins);
```
