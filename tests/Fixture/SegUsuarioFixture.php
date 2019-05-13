<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SegUsuarioFixture
 */
class SegUsuarioFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'seg_usuario';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'SEG_USUARIO' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'NOMBRE' => ['type' => 'string', 'length' => '30', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'APELLIDO_1' => ['type' => 'string', 'length' => '30', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'APELLIDO_2' => ['type' => 'string', 'length' => '30', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'NOMBRE_USUARIO' => ['type' => 'string', 'length' => '256', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'CONTRASENA' => ['type' => 'string', 'length' => '60', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'CORREO' => ['type' => 'string', 'length' => '256', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'NUMERO_TELEFONO' => ['type' => 'string', 'length' => '28', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'NACIONALIDAD' => ['type' => 'string', 'length' => '20', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ACTIVO' => ['type' => 'string', 'length' => '1', 'null' => true, 'default' => '\'1\'', 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'SEG_ROL' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'CODIGO_RESTAURACION' => ['type' => 'string', 'length' => '15', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['SEG_USUARIO'], 'length' => []],
            'SEG_ROL_USU_FK' => ['type' => 'foreign', 'columns' => ['SEG_ROL'], 'references' => ['OTS.SEG_ROL', 'SEG_ROL'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
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
                'NOMBRE' => 'Lorem ipsum dolor sit amet',
                'APELLIDO_1' => 'Lorem ipsum dolor sit amet',
                'APELLIDO_2' => 'Lorem ipsum dolor sit amet',
                'NOMBRE_USUARIO' => 'Lorem ipsum dolor sit amet',
                'CONTRASENA' => 'Lorem ipsum dolor sit amet',
                'CORREO' => 'Lorem ipsum dolor sit amet',
                'NUMERO_TELEFONO' => 'Lorem ipsum dolor sit amet',
                'NACIONALIDAD' => 'Lorem ipsum dolor ',
                'ACTIVO' => 'L',
                'SEG_ROL' => 1,
                'CODIGO_RESTAURACION' => 'Lorem ipsum d'
            ],
        ];
        parent::init();
    }
}
