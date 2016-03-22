<?hh // strict

namespace Caridea\Session;

class FlashPlugin extends Plugin
{
    protected \Caridea\Session\Map $curr;

    protected \Caridea\Session\Map $next;

    protected bool $moved = false;

    public function __construct()
    {
        $this->curr = new NullMap();
        $this->next = new NullMap();
    }
    
    public function clear(bool $current = false): void
    {
    }

    public function getAllCurrent(): \Iterator<mixed>
    {
        return $this->curr->getIterator();
    }

    public function getAllNext(): \Iterator<mixed>
    {
        return $this->next->getIterator();
    }

    public function getCurrent(string $name, mixed $alt = null): mixed
    {
        return null;
    }

    public function getNext(string $name, mixed $alt = null): mixed
    {
        return null;
    }

    public function keep(): void
    {
    }

    public function set(string $name, mixed $value, bool $current = false): void
    {
    }

    public function onStart(Session $session): void
    {
    }
    
    protected function cycle(): void
    {
    }
}
