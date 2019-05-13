<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SegPermisoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SegPermisoTable Test Case
 */
class SegPermisoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SegPermisoTable
     */
    public $SegPermiso;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SegPermiso',
        'app.SegPosee'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SegPermiso') ? [] : ['className' => SegPermisoTable::class];
        $this->SegPermiso = TableRegistry::getTableLocator()->get('SegPermiso', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SegPermiso);

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

    /**
     * Test SEG_POSEE_TraerPermisosPoseidos method
     *
     * @return void
     */
    public function testSEGPOSEETraerPermisosPoseidos()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test SEG_POSEE_AgregarRegistro method
     *
     * @return void
     */
    public function testSEGPOSEEAgregarRegistro()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test SEG_POSEE_EliminarRegistro method
     *
     * @return void
     */
    public function testSEGPOSEEEliminarRegistro()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
