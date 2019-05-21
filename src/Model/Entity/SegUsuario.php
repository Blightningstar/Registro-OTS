<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SegUsuario Entity
 *
 * @property int $SEG_USUARIO
 * @property string $NOMBRE
 * @property string $APELLIDO_1
 * @property string|null $APELLIDO_2
 * @property string $NOMBRE_USUARIO
 * @property string $CONTRASENA
 * @property string $CORREO
 * @property string $NUMERO_TELEFONO
 * @property string $NACIONALIDAD
 * @property string|null $ACTIVO
 * @property int $SEG_ROL
 * @property string|null $CODIGO_RESTAURACION
 */
class SegUsuario extends Entity
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
        'NOMBRE' => true,
        'APELLIDO_1' => true,
        'APELLIDO_2' => true,
        'NOMBRE_USUARIO' => true,
        'CONTRASENA' => true,
        'CORREO' => true,
        'NUMERO_TELEFONO' => true,
        'NACIONALIDAD' => true,
        'ACTIVO' => true,
        'SEG_ROL' => true,
        'CODIGO_R' => false
    ];
}
