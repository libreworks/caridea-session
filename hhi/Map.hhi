<?hh // strict

namespace Caridea\Session;

interface Map extends \Countable, \IteratorAggregate<mixed>, \ArrayAccess<string,mixed>
{
    public function clear(): void;

    public function get(string $key, mixed $alt = null) : mixed;

    public function merge(\Caridea\Session\Map $values): void;
}
