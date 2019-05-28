<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SolFecha Entity
 *
 * @property int $SEG_USUARIO
 * @property int $PRO_CURSO
 * @property int $SOL_PREGUNTA
 * @property \Cake\I18n\FrozenTime $RESPUESTA
 * @property string|null $ACTIVO
 */
class SolFecha extends Entity
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
        'RESPUESTA' => true,
        'ACTIVO' => true
    ];
}
