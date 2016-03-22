<?hh // strict

namespace Caridea\Session;

abstract class Plugin
{
    public function onStart(Session $session): void
    {
    }

    public function onRegenerate(Session $session): void
    {
    }

    public function onDestroy(Session $session): void
    {
    }
}
