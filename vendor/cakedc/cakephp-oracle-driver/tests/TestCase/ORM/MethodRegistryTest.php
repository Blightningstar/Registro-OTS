<?php
/**
 * Copyright 2015 - 2016, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2015 - 2016, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace CakeDC\OracleDriver\Test\TestCase\ORM;

use CakeDC\OracleDriver\ORM\Locator\LocatorInterface;
use CakeDC\OracleDriver\ORM\MethodRegistry;
use Cake\TestSuite\TestCase;

/**
 * Test case for MethodRegistry
 */
class MethodRegistryTest extends TestCase
{

    /**
     * Original MethodLocator.
     *
     * @var \CakeDC\OracleDriver\ORM\Locator\LocatorInterface
     */
    protected $_originalLocator;

    /**
     * Remember original instance to set it back on tearDown() just to make sure
     * other tests are not broken.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->_originalLocator = MethodRegistry::locator();
    }

    /**
     * tear down
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        MethodRegistry::locator($this->_originalLocator);
    }

    /**
     * Sets and returns mock LocatorInterface instance.
     *
     * @return \CakeDC\OracleDriver\ORM\Locator\LocatorInterface
     */
    protected function _setMockLocator()
    {
        $locator = $this->getMock('CakeDC\OracleDriver\ORM\Locator\LocatorInterface');
        MethodRegistry::locator($locator);

        return $locator;
    }

    /**
     * Test locator() method.
     *
     * @return void
     */
    public function testLocator()
    {
        $this->assertInstanceOf('CakeDC\OracleDriver\ORM\Locator\LocatorInterface', MethodRegistry::locator());

        $locator = $this->_setMockLocator();

        $this->assertSame($locator, MethodRegistry::locator());
    }

    /**
     * Test that locator() method is returing MethodLocator by default.
     *
     * @return void
     */
    public function testLocatorDefault()
    {
        $locator = MethodRegistry::locator();
        $this->assertInstanceOf('CakeDC\OracleDriver\ORM\Locator\MethodLocator', $locator);
    }

    /**
     * Test config() method.
     *
     * @return void
     */
    public function testConfig()
    {
        $locator = $this->_setMockLocator();
        $locator->expects($this->once())->method('config')->with('Test', []);

        MethodRegistry::config('Test', []);
    }

    /**
     * Test the get() method.
     *
     * @return void
     */
    public function testGet()
    {
        $locator = $this->_setMockLocator();
        $locator->expects($this->once())->method('get')->with('Test', []);

        MethodRegistry::get('Test', []);
    }

    /**
     * Test the get() method.
     *
     * @return void
     */
    public function testSet()
    {
        $method = $this->getMock('CakeDC\OracleDriver\ORM\Method');

        $locator = $this->_setMockLocator();
        $locator->expects($this->once())->method('set')->with('Test', $method);

        MethodRegistry::set('Test', $method);
    }

    /**
     * Test the remove() method.
     *
     * @return void
     */
    public function testRemove()
    {
        $locator = $this->_setMockLocator();
        $locator->expects($this->once())->method('remove')->with('Test');

        MethodRegistry::remove('Test');
    }

    /**
     * Test the clear() method.
     *
     * @return void
     */
    public function testClear()
    {
        $locator = $this->_setMockLocator();
        $locator->expects($this->once())->method('clear');

        MethodRegistry::clear();
    }
}
