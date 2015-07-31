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
 * Stores a token to help prevent Cross-site Request Forgery.
 *
 * @copyright 2015 LibreWorks contributors
 * @license   http://opensource.org/licenses/Apache-2.0 Apache 2.0 License
 */
class CsrfPlugin extends Plugin
{
    /**
     * @var \Caridea\Random\Generator A random value generator
     */
    protected $generator;
    /**
     * @var \Caridea\Session\Map A session value namespace
     */
    protected $values;
    
    /**
     * Creates a new CSRF plugin.
     *
     * For example, to create a plugin using the Mcrypt CSRNG:
     *
     * ```php
     * $csrf = new \Caridea\Session\CsrfPlugin(new \Caridea\Random\Mcrypt());
     * ```
     *
     * @param \Caridea\Random\Generator $generator A random value generator
     */
    public function __construct(\Caridea\Random\Generator $generator)
    {
        $this->generator = $generator;
        $this->values = new NullMap();
    }

    /**
     * Matches the client's CSRF token to the one stored in the session.
     *
     * @param string $value The client-supplied CSRF value
     * @return boolean
     */
    public function isValid($value)
    {
        return $value === $this->getValue();
    }
    
    /**
     * Gets the session CSRF token
     *
     * @return string The CSRF token
     */
    public function getValue()
    {
        return $this->values->get('value');
    }
    
    protected function regenerate()
    {
        $this->values->offsetSet('value', hash('sha512', $this->generator->generate(32)));
    }
    
    public function onRegenerate(Session $session)
    {
        $this->regenerate();
    }

    public function onStart(Session $session)
    {
        $this->values = $session->getValues(__CLASS__);
        if (!$this->values->get('value')) {
            $this->regenerate();
        }
    }
}
