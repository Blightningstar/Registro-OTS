<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolTextoMedioTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolTextoMedioTable Test Case
 */
class SolTextoMedioTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolTextoMedioTable
     */
    public $SolTextoMedio;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SolTextoMedio'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SolTextoMedio') ? [] : ['className' => SolTextoMedioTable::class];
        $this->SolTextoMedio = TableRegistry::getTableLocator()->get('SolTextoMedio', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolTextoMedio);

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
