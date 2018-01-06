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
 * A no-op key-value Map.
 *
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
class NullMap implements Map
{
    /**
     * {@inheritDoc}
     */
    public function clear(): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return 0;
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $key, $alt = null)
    {
        return $alt;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): \Iterator
    {
        return new \EmptyIterator();
    }

    /**
     * {@inheritDoc}
     */
    public function merge(Map $values): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
    }
}
