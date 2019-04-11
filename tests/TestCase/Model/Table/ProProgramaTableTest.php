<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProProgramaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProProgramaTable Test Case
 */
class ProProgramaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProProgramaTable
     */
    public $ProPrograma;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProPrograma'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProPrograma') ? [] : ['className' => ProProgramaTable::class];
        $this->ProPrograma = TableRegistry::getTableLocator()->get('ProPrograma', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProPrograma);

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
