<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProPrograma Entity
 *
 * @property string $PRO_PROGRAMA
 * @property string $NOMBRE
 * @property string|null $ACTIVO
 */
class ProPrograma extends Entity
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
        //'PRO_PROGRAMA' => true,
        'NOMBRE' => true,
        'ACTIVO' => true
    ];
}
