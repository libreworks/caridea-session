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
 * Generated by PHPUnit_SkeletonGenerator on 2015-05-30 at 12:07:59.
 */
class ValuesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Session
     */
    protected $session;

    protected function setUp()
    {
        $session = $this->createMock(Session::class);
        $session->expects($this->any())
            ->method('start')
            ->willReturn(true);
        $session->expects($this->any())
            ->method('resume')
            ->willReturn(true);
        $this->session = $session;

        $_SESSION = [];
    }

    protected function tearDown()
    {
        $_SESSION = [];
    }

    /**
     * @covers Caridea\Session\Values::__construct
     * @covers Caridea\Session\Values::offsetSet
     * @covers Caridea\Session\Values::count
     * @covers Caridea\Session\Values::clear
     * @covers Caridea\Session\Values::resume
     */
    public function testClear()
    {
        $object = new Values($this->session, 'foobar');
        $object->offsetSet('foo', 'bar');
        $this->assertEquals(1, $object->count());
        $object->clear();
        $this->assertEquals(0, $object->count());
    }

    /**
     * @covers Caridea\Session\Values::__construct
     * @covers Caridea\Session\Values::count
     */
    public function testCount()
    {
        $_SESSION['foobar'] = ['foo' => 'bar', 'bar' => 'foo'];
        $_SESSION['testing'] = [];
        $object = new Values($this->session, 'foobar');
        $this->assertEquals(2, $object->count());
        $object2 = new Values($this->session, 'testing');
        $this->assertEquals(0, $object2->count());
    }

    /**
     * @covers Caridea\Session\Values::__construct
     * @covers Caridea\Session\Values::get
     * @covers Caridea\Session\Values::offsetSet
     */
    public function testGet()
    {
        $object = new Values($this->session, 'foobar');
        $this->assertNull($object->get('foo'));
        $this->assertEquals(1, $object->get('foo', 1));
        $object->offsetSet('foo', 'bar');
        $this->assertEquals('bar', $object->get('foo'));
    }

    /**
     * @covers Caridea\Session\Values::__construct
     * @covers Caridea\Session\Values::getIterator
     */
    public function testGetIterator()
    {
        $object = new Values($this->session, 'foobar');
        $this->assertInstanceOf('ArrayIterator', $object->getIterator());
    }

    /**
     * @covers Caridea\Session\Values::__construct
     * @covers Caridea\Session\Values::getNamespace
     */
    public function testGetNamespace()
    {
        $namespace = 'foobar';
        $object = new Values($this->session, $namespace);
        $this->assertSame($namespace, $object->getNamespace());
    }

    /**
     * @covers Caridea\Session\Values::__construct
     * @covers Caridea\Session\Values::merge
     */
    public function testMerge()
    {
        $_SESSION['abc'] = ['foo' => 'bar'];
        $_SESSION['def'] = ['bar' => 'foo'];
        $object1 = new Values($this->session, 'abc');
        $object2 = new Values($this->session, 'def');
        $object1->merge($object2);
        $this->assertTrue($object1->offsetExists('bar'));

        $array = ['aoeu' => 'htns'];
        $iterator = new \ArrayIterator($array);
        $ht = $this->getMockBuilder(Map::class)
            ->setMethods(['getIterator', 'count', 'offsetExists', 'offsetGet',
                'offsetSet', 'offsetUnset'])
            ->getMockForAbstractClass();
        $ht->expects($this->any())
            ->method('getIterator')
            ->willReturn($iterator);
        $object1->merge($ht);
        $this->assertTrue($object1->offsetExists('aoeu'));
    }

    /**
     * @covers Caridea\Session\Values::__construct
     * @covers Caridea\Session\Values::offsetExists
     */
    public function testOffsetExists()
    {
        $object = new Values($this->session, 'foobar');
        $this->assertFalse($object->offsetExists('foo'));
        $object->offsetSet('foo', 'bar');
        $this->assertTrue($object->offsetExists('foo'));
        $this->assertFalse($object->offsetExists('bar'));
    }

    /**
     * @covers Caridea\Session\Values::__construct
     * @covers Caridea\Session\Values::offsetSet
     * @covers Caridea\Session\Values::offsetGet
     * @covers Caridea\Session\Values::offsetUnset
     * @covers Caridea\Session\Values::resume
     * @covers Caridea\Session\Values::start
     * @covers Caridea\Session\Values::init
     */
    public function testOffsetSetAndUnset()
    {
        $object = new Values($this->session, 'foobar');
        $object->offsetSet('foo', 'bar');
        $this->assertEquals('bar', $object->offsetGet('foo'));
        $object->offsetUnset('foo');
        $this->assertNull($object->offsetGet('foo'));
    }
}
