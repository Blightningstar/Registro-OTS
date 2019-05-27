<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolFechaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolFechaTable Test Case
 */
class SolFechaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolFechaTable
     */
    public $SolFecha;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SolFecha'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SolFecha') ? [] : ['className' => SolFechaTable::class];
        $this->SolFecha = TableRegistry::getTableLocator()->get('SolFecha', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolFecha);

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
