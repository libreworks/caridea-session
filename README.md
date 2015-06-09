# caridea-session
Caridea is a miniscule PHP application library. This shrimpy fellow is what you'd use when you just want some helping hands and not a full-blown framework.

![](http://libreworks.com/caridea-100.png)

This is the session component. It's used for controlling sessions (e.g. starting, resuming, destroying) as well as storing namespaced values within a session.

It supports plugins that get notified of session events. Included in this package are a CSRF prevention plugin and a "flash message" plugin.

## Installation

You can install this library using Composer:

```console
$ composer require caridea/session
```

This project requires PHP 5.5 and depends on `caridea/random`.

## Compliance

Releases of this library will conform to [Semantic Versioning](http://semver.org).

Our code is intended to comply with [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/), and [PSR-4](http://www.php-fig.org/psr/psr-4/). If you find any issues related to standards compliance, please send a pull request!

## Examples

Just a few quick examples.

Creating a Session.

```php
// When the session starts, a CSRF token will be created and stored
$csrf = new \Caridea\Session\CsrfPlugin(new \Caridea\Random\Mcrypt());
// Display-once messages can be added using the flash plugin
$flash = new \Caridea\Session\FlashPlugin();
$session = new \Caridea\Session\NativeSession($_COOKIE, [$csrf, $flash]);

$session->resume() || $session->start();

$flash->set('foo', 'bar');

$token = $csrf->getValue();

$values = $session->getValues('my-namespace');
$values['foobar'] = 'abc123';
```
