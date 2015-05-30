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
 * Session abstraction
 * 
 * @copyright 2015 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
interface Session
{
    /**
     * Whether a session had been started on a previous request.
     * 
     * @return boolean
     */
    public function canResume();
    
    /**
     * Completely destroys the session.
     * 
     * @return boolean
     */
    public function destroy();
    
    /**
     * Gets a namespaced set of keys to values.
     * 
     * If the session isn't started, a call to this method will start it.
     * 
     * @param string $namespace The value namespace
     * @return \Caridea\Util\Map A namespaced key-value map.
     */
    public function getValues($namespace);
    
    /**
     * Whether the session is already started.
     * 
     * @return boolean
     */
    public function isStarted();
    
    /**
     * Regenerates the session ID.
     *
     * @return boolean
     */
    public function regenerateId();
    
    /**
     * Resumes an existing session (returns true if one is started).
     *
     * @return boolean
     */
    public function resume();
    
    /**
     * Starts a session.
     *
     * @return boolean
     */
    public function start();    
}
