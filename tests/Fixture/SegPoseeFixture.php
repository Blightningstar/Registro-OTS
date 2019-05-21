<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SegPoseeFixture
 */
class SegPoseeFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'seg_posee';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'SEG_ROL' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'SEG_PERMISO' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['SEG_ROL', 'SEG_PERMISO'], 'length' => []],
            'SEG_PERMISO_POS_FK' => ['type' => 'foreign', 'columns' => ['SEG_PERMISO'], 'references' => ['OTS.SEG_PERMISO', 'SEG_PERMISO'], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
            'SEG_ROL_POS_FK' => ['type' => 'foreign', 'columns' => ['SEG_ROL'], 'references' => ['OTS.SEG_ROL', 'SEG_ROL'], 'update' => 'setNull', 'delete' => 'cascade', 'length' => []],
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
                'SEG_ROL' => 1,
                'SEG_PERMISO' => 1
            ],
        ];
        parent::init();
    }
}
