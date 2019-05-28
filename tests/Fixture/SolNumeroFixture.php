<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SolNumeroFixture
 */
class SolNumeroFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sol_numero';
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
        'RESPUESTA' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'ACTIVO' => ['type' => 'string', 'length' => '1', 'null' => true, 'default' => '\'1\'', 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['SEG_USUARIO', 'PRO_CURSO', 'SOL_PREGUNTA'], 'length' => []],
            'SOL_PREGUNTA_NUM_FK' => ['type' => 'foreign', 'columns' => ['SOL_PREGUNTA'], 'references' => ['OTS.SOL_PREGUNTA', 'SOL_PREGUNTA'], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
            'SOL_SOLICITUD_NUM_FK' => ['type' => 'foreign', 'columns' => ['SEG_USUARIO', 'PRO_CURSO'], 'references' => ['OTS.SOL_SOLICITUD', '1' => ['SEG_USUARIO', 'PRO_CURSO']], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
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
                'RESPUESTA' => 1,
                'ACTIVO' => 'L'
            ],
        ];
        parent::init();
    }
}
