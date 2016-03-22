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
 * @copyright 2015-2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
namespace Caridea\Session;

/**
 * Plugin for flash messages.
 *
 * @copyright 2015-2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class FlashPlugin extends Plugin
{
    /**
     * @var \Caridea\Session\Map A session value namespace for current vals
     */
    protected $curr;
    /**
     * @var \Caridea\Session\Map A session value namespace for next vals
     */
    protected $next;
    /**
     * @var bool whether the values have been moved
     */
    protected $moved = false;

    /**
     * Creates a new FlashPlugin.
     */
    public function __construct()
    {
        $this->curr = new NullMap();
        $this->next = new NullMap();
    }
    
    /**
     * Removes any flash values for the _next_ request, optionally also in the _current_.
     *
     * @param bool $current If true, also clears flash values from the _current_ request.
     */
    public function clear(bool $current = false)
    {
        if ($current) {
            $this->curr->clear();
        }
        $this->next->clear();
    }
    
    /**
     * Gets the flash values for the _current_ request.
     *
     * @return Iterator The current request flash values
     */
    public function getAllCurrent(): \Iterator
    {
        return $this->curr->getIterator();
    }
    
    /**
     * Gets the flash values for the _next_ request.
     *
     * @return Iterator The next request flash values
     */
    public function getAllNext(): \Iterator
    {
        return $this->next->getIterator();
    }
    
    /**
     * Gets the flash value for a key in the _current_ request.
     *
     * @param string $name The name
     * @param mixed $alt Optional default value to return
     * @return mixed The value, or the `$alt` if not found
     */
    public function getCurrent(string $name, $alt = null)
    {
        return $this->curr->get($name, $alt);
    }
    /**
     *
     * Gets the flash value for a key in the *next* request.
     *
     * @param string $name The name
     * @param mixed $alt Optional default value to return
     * @return mixed The value, or the `$alt` if not found
     */
    public function getNext(string $name, $alt = null)
    {
        return $this->next->get($name, $alt);
    }
    
    /**
     * Repeats any values in the current flash step in the next step.
     */
    public function keep()
    {
        $this->next->merge($this->curr);
    }
    
    /**
     * Sets a flash value for the _next_ request, optionally also in the _current_ request.
     *
     * @param string $name The name
     * @param mixed $value The value
     * @param bool $current If true, also sets flash value for the _current_ request.
     */
    public function set(string $name, $value, bool $current = false)
    {
        if ($current) {
            $this->curr->offsetSet($name, $value);
        }
        $this->next->offsetSet($name, $value);
    }
    
    public function onStart(Session $session)
    {
        $this->curr = $session->getValues(__CLASS__ . '\\CURR');
        $this->next = $session->getValues(__CLASS__ . '\\NEXT');
        $this->cycle();
    }
    
    protected function cycle()
    {
        if (!$this->moved) {
            $this->curr->clear();
            $this->curr->merge($this->next);
            $this->next->clear();
            $this->moved = true;
        }
    }
}
