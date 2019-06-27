<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolArchivoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolArchivoTable Test Case
 */
class SolArchivoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolArchivoTable
     */
    public $SolArchivo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SolArchivo'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SolArchivo') ? [] : ['className' => SolArchivoTable::class];
        $this->SolArchivo = TableRegistry::getTableLocator()->get('SolArchivo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolArchivo);

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
