<?hh // strict

namespace Caridea\Session;

class NullMap implements \Caridea\Session\Map
{
    public function clear(): void
    {
    }

    public function count(): int
    {
        return 0;
    }

    public function get(string $key, mixed $alt = null): mixed
    {
        return $alt;
    }

    public function getIterator(): \Iterator<mixed>
    {
        return new \EmptyIterator();
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
        return null;
    }

    public function offsetSet(string $offset, mixed $value): void
    {
    }

    public function offsetUnset(string $offset): void
    {
    }
}
