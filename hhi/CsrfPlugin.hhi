<?hh // strict

namespace Caridea\Session;

class CsrfPlugin extends Plugin
{
    protected \Caridea\Session\Map $values;
    
    public function __construct()
    {
        $this->values = new NullMap();
    }

    public function isValid(string $value): bool
    {
        return false;
    }
    
    public function getValue(): ?string
    {
        return null;
    }
    
    protected function regenerate(): void
    {
    }
    
    public function onRegenerate(Session $session): void
    {
    }

    public function onStart(Session $session): void
    {
    }
}
