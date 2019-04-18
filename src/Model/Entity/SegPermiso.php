<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SegPermiso Entity
 *
 * @property int $SEG_PERMISO
 * @property string|null $DESCRIPCION_ESP
 * @property string $DESCRIPCION_ING
 */
class SegPermiso extends Entity
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
        'DESCRIPCION_ESP' => true,
        'DESCRIPCION_ING' => true
    ];
}
