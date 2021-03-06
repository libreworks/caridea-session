<?php
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
 * Session value namespace
 *
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
class Values implements Map
{
    /**
     * @var Session
     */
    protected $session;
    /**
     * @var string
     */
    protected $name;

    /**
     * Creates a new Session value namespace.
     *
     * @param \Caridea\Session\Session $session The session utility
     * @param string $name The session value namespace
     */
    public function __construct(Session $session, string $name)
    {
        if ($name === null || !strlen(trim($name))) {
            throw new \InvalidArgumentException('Session namespace cannot be blank');
        }
        $this->name = $name;
        $this->session = $session;
    }

    /**
     * {@inheritDoc}
     */
    public function clear(): void
    {
        if ($this->resume()) {
            $_SESSION[$this->name] = [];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        $this->resume();
        return count($_SESSION[$this->name]);
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $offset, $alt = null)
    {
        $this->resume();
        return isset($_SESSION[$this->name][$offset]) ?
            $_SESSION[$this->name][$offset] : $alt;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): \Iterator
    {
        $this->resume();
        return new \ArrayIterator($_SESSION[$this->name]);
    }

    /**
     * Gets the values namespace in the session.
     *
     * @return string The values namespace
     */
    public function getNamespace(): string
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function merge(\Caridea\Session\Map $values): void
    {
        $this->start();
        if ($values instanceof Values) {
            $values->resume();
            $_SESSION[$this->name] = array_merge($_SESSION[$this->name], $_SESSION[$values->name]);
        } else {
            foreach ($values as $k => $v) {
                $_SESSION[$this->name][$k] = $v;
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset): bool
    {
        $this->resume();
        return isset($_SESSION[$this->name][$offset]);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        $this->resume();
        return $this->get($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->start();
        $_SESSION[$this->name][$offset] = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        if ($this->resume()) {
            unset($_SESSION[$this->name][$offset]);
        }
    }

    /**
     * Resumes the session.
     *
     * @return bool  Whether the session resumed successfully
     */
    protected function resume(): bool
    {
        return $this->session->resume() && $this->init();
    }

    /**
     * Starts the session, trying to resume it first.
     *
     * @return bool  Whether the session started successfully
     */
    protected function start(): bool
    {
        return $this->resume() || ($this->session->start() && $this->init());
    }

    /**
     * Initializes the session.
     *
     * @return bool  Always `true`
     */
    protected function init(): bool
    {
        if (!isset($_SESSION[$this->name])) {
            $_SESSION[$this->name] = [];
        }
        return true;
    }
}
