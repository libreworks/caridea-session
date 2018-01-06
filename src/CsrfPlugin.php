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
 * Stores a token to help prevent Cross-site Request Forgery.
 *
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
class CsrfPlugin extends Plugin
{
    /**
     * @var \Caridea\Session\Map A session value namespace
     */
    protected $values;

    /**
     * Creates a new CSRF plugin.
     */
    public function __construct()
    {
        $this->values = new NullMap();
    }

    /**
     * Matches the client's CSRF token to the one stored in the session.
     *
     * @param string $value The client-supplied CSRF value
     * @return bool
     */
    public function isValid(string $value): bool
    {
        return $value === $this->getValue();
    }

    /**
     * Gets the session CSRF token
     *
     * @return string|null The CSRF token (or null)
     */
    public function getValue(): ?string
    {
        return $this->values->get('value');
    }

    /**
     * Recalculates the hash
     */
    protected function regenerate(): void
    {
        $this->values->offsetSet('value', hash('sha512', random_bytes(32)));
    }

    /**
     * {@inheritDoc}
     */
    public function onRegenerate(Session $session): void
    {
        $this->regenerate();
    }

    /**
     * {@inheritDoc}
     */
    public function onStart(Session $session): void
    {
        $this->values = $session->getValues(__CLASS__);
        if (!$this->values->get('value')) {
            $this->regenerate();
        }
    }
}
