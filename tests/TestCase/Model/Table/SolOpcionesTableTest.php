<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolOpcionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolOpcionesTable Test Case
 */
class SolOpcionesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolOpcionesTable
     */
    public $SolOpciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SolOpciones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SolOpciones') ? [] : ['className' => SolOpcionesTable::class];
        $this->SolOpciones = TableRegistry::getTableLocator()->get('SolOpciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolOpciones);

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
