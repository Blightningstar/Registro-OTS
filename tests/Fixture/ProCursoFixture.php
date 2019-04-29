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
        'PRO_CURSO' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'SIGLA' => ['type' => 'string', 'length' => 8, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'NOMBRE' => ['type' => 'string', 'length' => 256, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'FECHA_INICIO' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'FECHA_FINALIZACION' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'FECHA_LIMITE' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'CREDITOS' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'IDIOMA' => ['type' => 'string', 'length' => 256, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'LOCACION' => ['type' => 'string', 'length' => 256, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ACTIVO' => ['type' => 'integer', 'length' => 1, 'unsigned' => true, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'PRO_PROGRAMA' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'SEG_USUARIO' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'SOL_FORMULARIO' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'SOL_FORMULARIO' => ['type' => 'index', 'columns' => ['SOL_FORMULARIO'], 'length' => []],
            'PRO_PROGRAMA' => ['type' => 'index', 'columns' => ['PRO_PROGRAMA'], 'length' => []],
            'SEG_USUARIO' => ['type' => 'index', 'columns' => ['SEG_USUARIO'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['PRO_CURSO'], 'length' => []],
            'pro_curso_ibfk_1' => ['type' => 'foreign', 'columns' => ['SOL_FORMULARIO'], 'references' => ['sol_formulario', 'SOL_FORMULARIO'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pro_curso_ibfk_2' => ['type' => 'foreign', 'columns' => ['PRO_PROGRAMA'], 'references' => ['pro_programa', 'PRO_PROGRAMA'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'pro_curso_ibfk_3' => ['type' => 'foreign', 'columns' => ['SEG_USUARIO'], 'references' => ['seg_usuario', 'SEG_USUARIO'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
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
                'FECHA_INICIO' => '2019-04-29',
                'FECHA_FINALIZACION' => '2019-04-29',
                'FECHA_LIMITE' => '2019-04-29',
                'CREDITOS' => 1,
                'IDIOMA' => 'Lorem ipsum dolor sit amet',
                'LOCACION' => 'Lorem ipsum dolor sit amet',
                'ACTIVO' => 1,
                'PRO_PROGRAMA' => 'Lorem ipsum dolor sit amet',
                'SEG_USUARIO' => 'Lorem ipsum dolor sit amet',
                'SOL_FORMULARIO' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
