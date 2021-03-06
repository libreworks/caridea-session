<?php
declare(strict_types=1);
/**
 * Caridea
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 *
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
namespace Caridea\Session;

/**
 * Session abstraction using PHP's native session functions
 *
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
class NativeSession implements Session
{
    /**
     * @var array Who told you you could eat *my* cookies?!
     */
    protected $cookies = [];
    /**
     * @var Values[] Array of values, with string namespace as key
     */
    protected $values = [];
    /**
     * @var \SplObjectStorage
     */
    protected $plugins;

    /**
     * Creates a new native session utility.
     *
     * For example, to create a session with two plugins:
     *
     * ```php
     * $csrf = new \Caridea\Session\CsrfPlugin(new \Caridea\Random\Mcrypt());
     * $flash = new \Caridea\Session\FlashPlugin();
     * $session = new \Caridea\Session\NativeSession($_COOKIE, [$csrf, $flash]);
     * ```
     *
     * @param array $cookies A copy of the client cookies, typically from $_COOKIE
     * @param Plugin[] $plugins Optional array of plugins to attach to the session
     */
    public function __construct(array $cookies, array $plugins = [])
    {
        $this->cookies = $cookies;
        $this->plugins = new \SplObjectStorage();
        foreach ($plugins as $plugin) {
            if ($plugin instanceof Plugin) {
                $this->plugins->attach($plugin);
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function canResume(): bool
    {
        return isset($this->cookies[session_name()]);
    }

    /**
     * {@inheritDoc}
     */
    public function clear(): void
    {
        session_unset();
    }

    /**
     * {@inheritDoc}
     */
    public function destroy(): bool
    {
        foreach (iterator_to_array($this->plugins) as $plugin) {
            /* @var $plugin Plugin */
            $plugin->onDestroy($this);
        }
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }
        return session_destroy();
    }

    /**
     * {@inheritDoc}
     */
    public function getValues(string $namespace): Map
    {
        if (!isset($this->values[$namespace])) {
            $this->values[$namespace] = new Values($this, $namespace);
        }
        return $this->values[$namespace];
    }

    /**
     * {@inheritDoc}
     */
    public function isStarted(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    /**
     * {@inheritDoc}
     */
    public function regenerateId(): bool
    {
        foreach (iterator_to_array($this->plugins) as $plugin) {
            /* @var $plugin Plugin */
            $plugin->onRegenerate($this);
        }
        return session_regenerate_id(true);
    }

    /**
     * {@inheritDoc}
     */
    public function resume(): bool
    {
        if ($this->isStarted()) {
            return true;
        } else {
            return $this->canResume() ? $this->start() : false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function start(): bool
    {
        $start = session_start();
        if ($start) {
            foreach (iterator_to_array($this->plugins) as $plugin) {
                /* @var $plugin Plugin */
                $plugin->onStart($this);
            }
        }
        return $start;
    }
}
