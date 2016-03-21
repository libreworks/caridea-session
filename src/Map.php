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
 * A Key-value Map.
 *
 * @copyright 2015-2016 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
interface Map extends \Countable, \IteratorAggregate, \ArrayAccess
{
    /**
     * Removes all values.
     */
    public function clear();

    /**
     * Gets a single value, or return `$alt` if not found.
     *
     * @param string $key The name of the value
     * @param mixed $alt Optional default value to return
     * @return mixed The value, or the `$alt` if not found
     */
    public function get($key, $alt = null);
    
    /**
     * Adds all key-value pairs from the supplied `$values` to this one.
     *
     * Values in the incoming `Map` with identical keys will overwrite
     * those in this one.
     *
     * @param \Caridea\Session\Map $values The incoming values
     */
    public function merge(Map $values);
}
