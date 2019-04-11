<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolPreguntaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolPreguntaTable Test Case
 */
class SolPreguntaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolPreguntaTable
     */
    public $SolPregunta;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SolPregunta'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SolPregunta') ? [] : ['className' => SolPreguntaTable::class];
        $this->SolPregunta = TableRegistry::getTableLocator()->get('SolPregunta', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolPregunta);

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
