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
 * @copyright 2015-2018 LibreWorks contributors
 * @license   Apache-2.0
 */
namespace Caridea\Session;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-05-30 at 13:06:56.
 */
class PluginTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Plugin
     */
    protected $object;
    /**
     * @var Session
     */
    protected $session;

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = $this->getMockForAbstractClass(Plugin::class);
        $this->session = $this->getMockForAbstractClass(Session::class);
    }

    /**
     * @covers Caridea\Session\Plugin::onStart
     */
    public function testOnStart()
    {
        $this->object->onStart($this->session);
    }

    /**
     * @covers Caridea\Session\Plugin::onRegenerate
     */
    public function testOnRegenerate()
    {
        $this->object->onRegenerate($this->session);
    }

    /**
     * @covers Caridea\Session\Plugin::onDestroy
     */
    public function testOnDestroy()
    {
        $this->object->onDestroy($this->session);
    }
}
