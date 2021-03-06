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
 * Session event plugin
 *
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
abstract class Plugin
{
    /**
     * Called immediately after a session starts.
     *
     * @param \Caridea\Session\Session $session The session that was started
     */
    public function onStart(Session $session): void
    {
    }

    /**
     * Called immediately before a session ID is regenerated.
     *
     * @param \Caridea\Session\Session $session The session that was regenerated
     */
    public function onRegenerate(Session $session): void
    {
    }

    /**
     * Called immediately before a session is destroyed.
     *
     * @param \Caridea\Session\Session $session The session that was destroyed
     */
    public function onDestroy(Session $session): void
    {
    }
}
