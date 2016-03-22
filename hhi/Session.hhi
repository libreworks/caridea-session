<?hh // strict

namespace Caridea\Session;

interface Session
{
    public function canResume(): bool;

    public function clear(): void;

    public function destroy(): bool;

    public function getValues(string $namespace): \Caridea\Session\Map;
    
    public function isStarted(): bool;
    
    public function regenerateId(): bool;
    
    public function resume(): bool;
    
    public function start(): bool;
}
