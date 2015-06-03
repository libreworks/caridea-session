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
 * Generated by PHPUnit_SkeletonGenerator on 2015-05-30 at 13:25:21.
 */
class CsrfPluginTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CsrfPlugin
     */
    protected $object;
    /**
     * @var \Caridea\Random\Generator
     */
    protected $generator;
    /**
     * @var Session
     */
    protected $session;

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $generator = $this->getMockBuilder(\Caridea\Random\Generator::class)
            ->setMethods(['generate'])
            ->getMockForAbstractClass();
        $generator->expects($this->any())
            ->method('generate')
            ->willReturnCallback(function($length){
                return str_pad((string)mt_rand(0, 1000), $length, '1');
            });
        $this->generator = $generator;
        
        $this->object = new CsrfPlugin($generator);
        
        $session = $this->getMockBuilder(Session::class)
            ->setMethods(['getValues'])
            ->getMockForAbstractClass();
        $session->expects($this->any())
            ->method('getValues')
            ->willReturnCallback(function($namespace) use ($session){
                return new Values($session, $namespace);
            });
        $this->session = $session;
    }
    
    /**
     * @covers Caridea\Session\CsrfPlugin::isValid
     * @covers Caridea\Session\CsrfPlugin::onStart
     */
    public function testIsValid()
    {
        $this->object->onStart($this->session);
        $hash = $_SESSION[CsrfPlugin::class]['value'];
        $this->assertTrue($this->object->isValid($hash));
    }

    /**
     * @covers Caridea\Session\CsrfPlugin::__construct
     * @covers Caridea\Session\CsrfPlugin::getValue
     * @covers Caridea\Session\CsrfPlugin::onStart
     */
    public function testGetValue()
    {
        $this->object->onStart($this->session);
        $value = $this->object->getValue();
        $this->assertEquals(128, strlen($value));
        $this->object->onStart($this->session);
        $this->assertEquals($value, $this->object->getValue());
    }

    /**
     * @covers Caridea\Session\CsrfPlugin::onRegenerate
     * @covers Caridea\Session\CsrfPlugin::regenerate
     * @covers Caridea\Session\CsrfPlugin::onStart
     */
    public function testOnRegenerate()
    {
        $this->object->onStart($this->session);
        $value1 = $this->object->getValue();
        $this->object->onRegenerate($this->session);
        $value2 = $this->object->getValue();
        $this->assertNotSame($value1, $value2);
        $this->object->onStart($this->session);
        $this->assertSame($value2, $this->object->getValue());
    }

    /**
     * @covers Caridea\Session\CsrfPlugin::onStart
     */
    public function testOnStart()
    {
        $_SESSION[CsrfPlugin::class] = ['value' => hash('sha512', str_pad((string)mt_rand(0, 1000), 32, '1'))];
        $this->object->onStart($this->session);
        $this->assertEquals($_SESSION[CsrfPlugin::class]['value'], $this->object->getValue());
    }
}
