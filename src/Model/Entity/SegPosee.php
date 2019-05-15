<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SegPosee Entity
 *
 * @property int $SEG_ROL
 * @property int $SEG_PERMISO
 */
class SegPosee extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        //'*' => true,
        'SEG_ROL' => false,
        'SEG_PERMISO' => false
    ];
}
