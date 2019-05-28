<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SolContieneFixture
 */
class SolContieneFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sol_contiene';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'SOL_PREGUNTA' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'SOL_FORMULARIO' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'NUMERO_PREGUNTA' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['SOL_PREGUNTA', 'SOL_FORMULARIO'], 'length' => []],
            'SOL_FORMULARIO_CON_FK' => ['type' => 'foreign', 'columns' => ['SOL_FORMULARIO'], 'references' => ['OTS.SOL_FORMULARIO', 'SOL_FORMULARIO'], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
            'SOL_PREGUNTA_CON_FK' => ['type' => 'foreign', 'columns' => ['SOL_PREGUNTA'], 'references' => ['OTS.SOL_PREGUNTA', 'SOL_PREGUNTA'], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
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
                'SOL_PREGUNTA' => 1,
                'SOL_FORMULARIO' => 1,
                'NUMERO_PREGUNTA' => 1
            ],
        ];
        parent::init();
    }
}
