<?hh // strict

namespace Caridea\Session;

class NativeSession implements Session
{
    protected array<string,string> $cookies = [];

    protected array<string,Values> $values = [];

    protected \SplObjectStorage<Plugin,mixed> $plugins;

    public function __construct(array<string,string> $cookies, array<Plugin> $plugins = [])
    {
        $this->plugins = new \SplObjectStorage();
    }
    
    public function canResume(): bool
    {
        return false;
    }

    public function clear(): void
    {
    }
    
    public function destroy(): bool
    {
        return false;
    }
    
    public function getValues(string $namespace): \Caridea\Session\Map
    {
        return new NullMap();
    }

    public function isStarted(): bool
    {
        return false;
    }

    public function regenerateId(): bool
    {
        return false;
    }

    public function resume(): bool
    {
        return false;
    }

    public function start(): bool
    {
        return false;
    }
}
