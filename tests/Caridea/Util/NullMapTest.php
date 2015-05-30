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
namespace Caridea\Util;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-05-30 at 13:44:23.
 */
class NullMapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NullMap
     */
    protected $object;

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new NullMap();
    }

    /**
     * @covers Caridea\Util\NullMap::clear
     */
    public function testClear()
    {
        $this->object->clear();
    }

    /**
     * @covers Caridea\Util\NullMap::count
     */
    public function testCount()
    {
        $this->assertEquals(0, $this->object->count());
    }

    /**
     * @covers Caridea\Util\NullMap::get
     */
    public function testGet()
    {
        $this->assertNull($this->object->get('foo'));
        $this->assertEquals('bar', $this->object->get('foo', 'bar'));
    }

    /**
     * @covers Caridea\Util\NullMap::getIterator
     */
    public function testGetIterator()
    {
        $this->assertInstanceOf('EmptyIterator', $this->object->getIterator());
    }

    /**
     * @covers Caridea\Util\NullMap::merge
     */
    public function testMerge()
    {
        $this->object->merge($this->object);
    }

    /**
     * @covers Caridea\Util\NullMap::offsetExists
     */
    public function testOffsetExists()
    {
        $this->assertFalse($this->object->offsetExists('foo'));
    }

    /**
     * @covers Caridea\Util\NullMap::offsetGet
     */
    public function testOffsetGet()
    {
        $this->assertNull($this->object->offsetGet('foo'));
    }

    /**
     * @covers Caridea\Util\NullMap::offsetSet
     */
    public function testOffsetSet()
    {
        $this->object->offsetSet('foo', 'bar');
    }

    /**
     * @covers Caridea\Util\NullMap::offsetUnset
     */
    public function testOffsetUnset()
    {
        $this->object->offsetUnset('foo', 'bar');
    }
}
