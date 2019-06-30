<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SolArchivoFixture
 */
class SolArchivoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sol_archivo';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'SEG_USUARIO' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'PRO_CURSO' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'SOL_PREGUNTA' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'NUMERO_RESPUESTA' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'RESPUESTA' => ['type' => 'string', 'length' => '128', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['SEG_USUARIO', 'PRO_CURSO', 'SOL_PREGUNTA', 'NUMERO_RESPUESTA'], 'length' => []],
            'SOL_PREGUNTA_ARC_FK' => ['type' => 'foreign', 'columns' => ['SOL_PREGUNTA'], 'references' => ['OTS.SOL_PREGUNTA', 'SOL_PREGUNTA'], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
            'SEG_USUARIO_ARC_FK' => ['type' => 'foreign', 'columns' => ['SEG_USUARIO'], 'references' => ['OTS.SEG_USUARIO', 'SEG_USUARIO'], 'update' => 'setNull', 'delete' => 'noAction', 'length' => []],
            'PRO_CURSO_ARC_FK' => ['type' => 'foreign', 'columns' => ['PRO_CURSO'], 'references' => ['OTS.PRO_CURSO', 'PRO_CURSO'], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
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
                'SOL_PREGUNTA' => 1,
                'NUMERO_RESPUESTA' => 1,
                'RESPUESTA' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
