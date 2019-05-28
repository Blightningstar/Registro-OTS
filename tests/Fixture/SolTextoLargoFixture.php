<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SolTextoLargoFixture
 */
class SolTextoLargoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sol_texto_largo';
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
        'RESPUESTA' => ['type' => 'string', 'length' => '4000', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ACTIVO' => ['type' => 'string', 'length' => '1', 'null' => true, 'default' => '\'1\'', 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['SEG_USUARIO', 'PRO_CURSO', 'SOL_PREGUNTA'], 'length' => []],
            'SOL_PREGUNTA_TLG_FK' => ['type' => 'foreign', 'columns' => ['SOL_PREGUNTA'], 'references' => ['OTS.SOL_PREGUNTA', 'SOL_PREGUNTA'], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
            'SOL_SOLICITUD_TLG_FK' => ['type' => 'foreign', 'columns' => ['SEG_USUARIO', 'PRO_CURSO'], 'references' => ['OTS.SOL_SOLICITUD', '1' => ['SEG_USUARIO', 'PRO_CURSO']], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
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
                'RESPUESTA' => 'Lorem ipsum dolor sit amet',
                'ACTIVO' => 'L'
            ],
        ];
        parent::init();
    }
}
