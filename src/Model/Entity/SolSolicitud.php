<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SolSolicitud Entity
 *
 * @property int $SEG_USUARIO
 * @property int $PRO_CURSO
 * @property string|null $RESULTADO
 * @property string|null $ACTIVO
 */
class SolSolicitud extends Entity
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
        'RESULTADO' => true,
        'ACTIVO' => true
    ];
}
