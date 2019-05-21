<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SegPoseeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SegPoseeTable Test Case
 */
class SegPoseeTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SegPoseeTable
     */
    public $SegPosee;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SegPosee'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SegPosee') ? [] : ['className' => SegPoseeTable::class];
        $this->SegPosee = TableRegistry::getTableLocator()->get('SegPosee', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SegPosee);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
