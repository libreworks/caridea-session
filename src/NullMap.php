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
 * @copyright 2015-2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
namespace Caridea\Session;

/**
 * A no-op key-value Map.
 *
 * @copyright 2015-2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class NullMap implements Map
{
    public function clear()
    {
    }

    public function count()
    {
        return 0;
    }

    public function get($key, $alt = null)
    {
        return $alt;
    }

    public function getIterator()
    {
        return new \EmptyIterator();
    }

    public function merge(Map $values)
    {
    }
    
    public function offsetExists($offset)
    {
        return false;
    }

    public function offsetGet($offset)
    {
        return null;
    }

    public function offsetSet($offset, $value)
    {
    }

    public function offsetUnset($offset)
    {
    }
}
