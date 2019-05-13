<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProProgramaFixture
 */
class ProProgramaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'pro_programa';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'PRO_PROGRAMA' => ['type' => 'string', 'length' => '3', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'NOMBRE' => ['type' => 'string', 'length' => '20', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ACTIVO' => ['type' => 'string', 'length' => '1', 'null' => true, 'default' => '\'1\'', 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['PRO_PROGRAMA'], 'length' => []],
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
                'PRO_PROGRAMA' => 'bd30c4af-4e41-465a-b8af-2ffb7a493608',
                'NOMBRE' => 'Lorem ipsum dolor ',
                'ACTIVO' => 'L'
            ],
        ];
        parent::init();
    }
}
