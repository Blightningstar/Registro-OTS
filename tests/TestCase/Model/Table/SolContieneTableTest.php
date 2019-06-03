<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolContieneTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolContieneTable Test Case
 */
class SolContieneTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolContieneTable
     */
    public $SolContiene;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SolContiene'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SolContiene') ? [] : ['className' => SolContieneTable::class];
        $this->SolContiene = TableRegistry::getTableLocator()->get('SolContiene', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolContiene);

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
