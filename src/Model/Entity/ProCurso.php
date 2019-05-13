<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProCurso Entity
 *
 * @property int $PRO_CURSO
 * @property string $SIGLA
 * @property string $NOMBRE
 * @property \Cake\I18n\FrozenTime $FECHA_INICIO
 * @property \Cake\I18n\FrozenTime $FECHA_FINALIZACION
 * @property \Cake\I18n\FrozenTime $FECHA_LIMITE
 * @property int|null $CREDITOS
 * @property string $IDIOMA
 * @property string $LOCACION
 * @property string|null $ACTIVO
 * @property string|null $PRO_PROGRAMA
 * @property int|null $SOL_FORMULARIO
 * @property int|null $SEG_USUARIO
 */
class ProCurso extends Entity
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
        'SIGLA' => true,
        'NOMBRE' => true,
        'FECHA_INICIO' => true,
        'FECHA_FINALIZACION' => true,
        'FECHA_LIMITE' => true,
        'CREDITOS' => true,
        'IDIOMA' => true,
        'LOCACION' => true,
        'ACTIVO' => true,
        'PRO_PROGRAMA' => true,
        'SOL_FORMULARIO' => true,
        'SEG_USUARIO' => true
    ];
}
