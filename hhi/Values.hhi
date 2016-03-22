<?hh // strict

namespace Caridea\Session;

class Values implements \Caridea\Session\Map
{
    protected Session $session;

    protected string $name;

    public function __construct(Session $session, string $name)
    {
        $this->session = $session;
        $this->name = $name;
    }
    
    public function clear(): void
    {
    }

    public function count(): int
    {
        return 0;
    }

    public function get(string $offset, mixed $alt = null): mixed
    {
        return $alt;
    }
    
    public function getIterator(): \Iterator<mixed>
    {
        return new \ArrayIterator([]);
    }

    public function getNamespace(): string
    {
        return $this->name;
    }

    public function merge(\Caridea\Session\Map $values): void
    {
    }
    
    public function offsetExists(string $offset): bool
    {
        return false;
    }

    public function offsetGet(string $offset): mixed
    {
        return $this->get($offset);
    }

    public function offsetSet(string $offset, mixed $value): void
    {
    }

    public function offsetUnset(string $offset): void
    {
    }
    
    protected function resume(): bool
    {
        return false;
    }
    
    protected function start(): bool
    {
        return false;
    }
    
    protected function init(): bool
    {
        return true;
    }
}
