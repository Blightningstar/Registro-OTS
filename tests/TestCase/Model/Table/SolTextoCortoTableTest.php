<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolTextoCortoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolTextoCortoTable Test Case
 */
class SolTextoCortoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolTextoCortoTable
     */
    public $SolTextoCorto;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SolTextoCorto'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SolTextoCorto') ? [] : ['className' => SolTextoCortoTable::class];
        $this->SolTextoCorto = TableRegistry::getTableLocator()->get('SolTextoCorto', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolTextoCorto);

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
