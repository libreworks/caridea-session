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
 * @copyright 2015 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
namespace Caridea\Session;

/**
 * Session value namespace
 * 
 * @copyright 2015 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class Values implements \Caridea\Util\Map
{
    /**
     * @var string
     */
    protected $name;
    
    /**
     * Creates a new Session value namespace.
     * 
     * The session will be started by this constructor.
     * 
     * @param \Caridea\Session\Session $session The session utility
     * @param string $name The session value namespace
     */
    public function __construct(Session $session, $name)
    {
        $this->name = \Caridea\Util\Arguments::checkBlank($name, 'Session namespace cannot be blank');
        $session->resume() || $session->start();
        if (!isset($_SESSION[$this->name])) {
            $_SESSION[$this->name] = [];
        }
    }
    
    public function clear()
    {
        $_SESSION[$this->name] = [];
    }

    public function count()
    {
        return count($_SESSION[$this->name]);
    }

    public function get($offset, $alt = null)
    {
        return isset($_SESSION[$this->name][$offset]) ?
            $_SESSION[$this->name][$offset] : $alt;
    }
    
    public function getIterator()
    {
        return new \ArrayIterator($_SESSION[$this->name]);
    }

    /**
     * Gets the values namespace in the session.
     * 
     * @return string The values namespace
     */
    public function getNamespace()
    {
        return $this->name;
    }

    public function merge(\Caridea\Util\Map $values)
    {
        if ($values instanceof Values) {
            $_SESSION[$this->name] = array_merge($_SESSION[$this->name], $_SESSION[$values->name]);
        } else {
            foreach($values as $k => $v) {
                $_SESSION[$this->name][$k] = $v;
            }
        }
    }
    
    public function offsetExists($offset)
    {
        return isset($_SESSION[$this->name][$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $_SESSION[$this->name][$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($_SESSION[$this->name][$offset]);
    }
}
