<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolSolicitudTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolSolicitudTable Test Case
 */
class SolSolicitudTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolSolicitudTable
     */
    public $SolSolicitud;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SolSolicitud'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SolSolicitud') ? [] : ['className' => SolSolicitudTable::class];
        $this->SolSolicitud = TableRegistry::getTableLocator()->get('SolSolicitud', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolSolicitud);

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
