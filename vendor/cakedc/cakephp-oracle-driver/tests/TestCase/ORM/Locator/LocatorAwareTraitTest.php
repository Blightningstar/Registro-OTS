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

namespace CakeDC\OracleDriver\Test\TestCase\ORM\Locator;

use CakeDC\OracleDriver\ORM\MethodRegistry;
use Cake\TestSuite\TestCase;

/**
 * LocatorAwareTrait test case
 *
 */
class LocatorAwareTraitTest extends TestCase
{

    /**
     * setup
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->subject = $this->getObjectForTrait('CakeDC\OracleDriver\ORM\Locator\LocatorAwareTrait');
    }

    /**
     * Tests methodLocator method
     *
     * @return void
     */
    public function testMethodLocator()
    {
        $methodLocator = $this->subject->methodLocator();
        $this->assertSame(MethodRegistry::locator(), $methodLocator);
        /*
        $newLocator = $this->getMock('CakeDC\OracleDriver\ORM\Locator\LocatorInterface');
        $subjectLocator = $this->subject->methodLocator($newLocator);
        $this->assertSame($newLocator, $subjectLocator);
        */
    }
}
