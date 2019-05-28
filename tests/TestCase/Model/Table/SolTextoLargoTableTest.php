<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolTextoLargoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolTextoLargoTable Test Case
 */
class SolTextoLargoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolTextoLargoTable
     */
    public $SolTextoLargo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SolTextoLargo'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SolTextoLargo') ? [] : ['className' => SolTextoLargoTable::class];
        $this->SolTextoLargo = TableRegistry::getTableLocator()->get('SolTextoLargo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolTextoLargo);

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
