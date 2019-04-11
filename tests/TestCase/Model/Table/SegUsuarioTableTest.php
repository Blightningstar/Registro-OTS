<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SegUsuarioTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SegUsuarioTable Test Case
 */
class SegUsuarioTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SegUsuarioTable
     */
    public $SegUsuario;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SegUsuario'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SegUsuario') ? [] : ['className' => SegUsuarioTable::class];
        $this->SegUsuario = TableRegistry::getTableLocator()->get('SegUsuario', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SegUsuario);

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
