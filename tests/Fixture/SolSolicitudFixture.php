<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SolSolicitudFixture
 */
class SolSolicitudFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sol_solicitud';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'SEG_USUARIO' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'PRO_CURSO' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'RESULTADO' => ['type' => 'string', 'length' => '9', 'null' => true, 'default' => '\'Proceso\'', 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ACTIVO' => ['type' => 'string', 'length' => '1', 'null' => true, 'default' => '\'1\'', 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['SEG_USUARIO', 'PRO_CURSO'], 'length' => []],
            'SEG_USUARIO_SOL_FK' => ['type' => 'foreign', 'columns' => ['SEG_USUARIO'], 'references' => ['OTS.SEG_USUARIO', 'SEG_USUARIO'], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
            'PRO_CURSO_SOL_FK' => ['type' => 'foreign', 'columns' => ['PRO_CURSO'], 'references' => ['OTS.PRO_CURSO', 'PRO_CURSO'], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
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
                'SEG_USUARIO' => 1,
                'PRO_CURSO' => 1,
                'RESULTADO' => 'Lorem i',
                'ACTIVO' => 'L'
            ],
        ];
        parent::init();
    }
}
