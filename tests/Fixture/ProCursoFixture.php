<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProCursoFixture
 */
class ProCursoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'pro_curso';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'PRO_CURSO' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'SIGLA' => ['type' => 'string', 'length' => '8', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'NOMBRE' => ['type' => 'string', 'length' => '64', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'FECHA_INICIO' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null],
        'FECHA_FINALIZACION' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null],
        'FECHA_LIMITE' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null],
        'CREDITOS' => ['type' => 'integer', 'length' => null, 'null' => true, 'default' => '4', 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'IDIOMA' => ['type' => 'string', 'length' => '16', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'LOCACION' => ['type' => 'string', 'length' => '64', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ACTIVO' => ['type' => 'string', 'length' => '1', 'null' => true, 'default' => '\'1\'', 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'PRO_PROGRAMA' => ['type' => 'string', 'length' => '3', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'SOL_FORMULARIO' => ['type' => 'integer', 'length' => null, 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'SEG_USUARIO' => ['type' => 'integer', 'length' => null, 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['PRO_CURSO'], 'length' => []],
            'PRO_PROGRAMA_CUR_FK' => ['type' => 'foreign', 'columns' => ['PRO_PROGRAMA'], 'references' => ['OTS.PRO_PROGRAMA', 'PRO_PROGRAMA'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
            'SOL_FORMULARIO_CUR_FK' => ['type' => 'foreign', 'columns' => ['SOL_FORMULARIO'], 'references' => ['OTS.SOL_FORMULARIO', 'SOL_FORMULARIO'], 'update' => 'setNull', 'delete' => 'setNull', 'length' => []],
            'SEG_USUARIO_CUR_FK' => ['type' => 'foreign', 'columns' => ['SEG_USUARIO'], 'references' => ['OTS.SEG_USUARIO', 'SEG_USUARIO'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
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
                'PRO_CURSO' => 1,
                'SIGLA' => 'Lorem ',
                'NOMBRE' => 'Lorem ipsum dolor sit amet',
                'FECHA_INICIO' => '2019-05-13 09:43:46',
                'FECHA_FINALIZACION' => '2019-05-13 09:43:46',
                'FECHA_LIMITE' => '2019-05-13 09:43:46',
                'CREDITOS' => 1,
                'IDIOMA' => 'Lorem ipsum do',
                'LOCACION' => 'Lorem ipsum dolor sit amet',
                'ACTIVO' => 'L',
                'PRO_PROGRAMA' => 'L',
                'SOL_FORMULARIO' => 1,
                'SEG_USUARIO' => 1
            ],
        ];
        parent::init();
    }
}
