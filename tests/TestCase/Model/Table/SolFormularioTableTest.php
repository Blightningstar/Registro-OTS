<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolFormularioTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolFormularioTable Test Case
 */
class SolFormularioTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolFormularioTable
     */
    public $SolFormulario;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SolFormulario'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SolFormulario') ? [] : ['className' => SolFormularioTable::class];
        $this->SolFormulario = TableRegistry::getTableLocator()->get('SolFormulario', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolFormulario);

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
