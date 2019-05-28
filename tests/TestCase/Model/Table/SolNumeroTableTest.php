<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolNumeroTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolNumeroTable Test Case
 */
class SolNumeroTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolNumeroTable
     */
    public $SolNumero;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SolNumero'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SolNumero') ? [] : ['className' => SolNumeroTable::class];
        $this->SolNumero = TableRegistry::getTableLocator()->get('SolNumero', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolNumero);

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
