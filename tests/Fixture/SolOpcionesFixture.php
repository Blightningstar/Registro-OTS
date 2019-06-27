<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SolOpcionesFixture
 */
class SolOpcionesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'SOL_OPCIONES' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'SOL_PREGUNTA' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'DESCRIPCION_ESP' => ['type' => 'string', 'length' => '256', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'DESCRIPCION_ING' => ['type' => 'string', 'length' => '256', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['SOL_OPCIONES', 'SOL_PREGUNTA'], 'length' => []],
            'SOL_PREGUNTA_OPC_FK' => ['type' => 'foreign', 'columns' => ['SOL_PREGUNTA'], 'references' => ['OTS.SOL_PREGUNTA', 'SOL_PREGUNTA'], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'SOL_OPCIONES' => 1,
                'SOL_PREGUNTA' => 1,
                'DESCRIPCION_ESP' => 'Lorem ipsum dolor sit amet',
                'DESCRIPCION_ING' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
