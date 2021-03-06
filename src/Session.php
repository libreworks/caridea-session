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
 * Session abstraction
 *
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
interface Session
{
    /**
     * Whether a session had been started on a previous request.
     *
     * @return bool
     */
    public function canResume(): bool;

    /**
     * Unsets all session variables, leaving the session otherwise intact.
     */
    public function clear(): void;

    /**
     * Completely destroys the session.
     *
     * @return bool
     */
    public function destroy(): bool;

    /**
     * Gets a namespaced set of keys to values.
     *
     * If the session isn't started, a call to this method will start it.
     *
     * @param string $namespace The value namespace
     * @return \Caridea\Session\Map A namespaced key-value map.
     */
    public function getValues(string $namespace): Map;

    /**
     * Whether the session is already started.
     *
     * @return bool
     */
    public function isStarted(): bool;

    /**
     * Regenerates the session ID.
     *
     * @return bool
     */
    public function regenerateId(): bool;

    /**
     * Resumes an existing session (returns true if one is started).
     *
     * @return bool
     */
    public function resume(): bool;

    /**
     * Starts a session.
     *
     * @return bool
     */
    public function start(): bool;
}
