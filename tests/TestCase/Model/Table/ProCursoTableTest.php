<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProCursoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProCursoTable Test Case
 */
class ProCursoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProCursoTable
     */
    public $ProCurso;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProCurso'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProCurso') ? [] : ['className' => ProCursoTable::class];
        $this->ProCurso = TableRegistry::getTableLocator()->get('ProCurso', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProCurso);

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
