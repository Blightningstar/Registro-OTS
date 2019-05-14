<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SolPreguntaFixture
 */
class SolPreguntaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'SOL_PREGUNTA';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'SOL_PREGUNTA' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'DESCRIPCION_ESP' => ['type' => 'string', 'length' => '256', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'DESCRIPCION_ING' => ['type' => 'string', 'length' => '256', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TIPO' => ['type' => 'integer', 'length' => null, 'null' => true, 'default' => '\'1\'', 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'REQUERIDO' => ['type' => 'string', 'length' => '1', 'null' => true, 'default' => '\'1\'', 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ACTIVO' => ['type' => 'string', 'length' => '1', 'null' => true, 'default' => '\'1\'', 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['SOL_PREGUNTA'], 'length' => []],
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
                'DESCRIPCION_ESP' => 'Lorem ipsum dolor sit amet',
                'DESCRIPCION_ING' => 'Lorem ipsum dolor sit amet',
                'TIPO' => 1,
                'REQUERIDO' => 'L',
                'ACTIVO' => 'L'
            ],
        ];
        parent::init();
    }
}
