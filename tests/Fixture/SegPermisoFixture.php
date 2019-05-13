<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SegPermisoFixture
 */
class SegPermisoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'seg_permiso';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'SEG_PERMISO' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'DESCRIPCION_ESP' => ['type' => 'string', 'length' => '256', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'DESCRIPCION_ING' => ['type' => 'string', 'length' => '256', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['SEG_PERMISO'], 'length' => []],
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
                'SEG_PERMISO' => 1,
                'DESCRIPCION_ESP' => 'Lorem ipsum dolor sit amet',
                'DESCRIPCION_ING' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
