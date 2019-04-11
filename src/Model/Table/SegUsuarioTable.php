<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SegUsuario Model
 *
 * @method \App\Model\Entity\SegUsuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\SegUsuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SegUsuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SegUsuario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SegUsuario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SegUsuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SegUsuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SegUsuario findOrCreate($search, callable $callback = null, $options = [])
 */
class SegUsuarioTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('seg_usuario');
        $this->setDisplayField('SEG_USUARIO');
        $this->setPrimaryKey('SEG_USUARIO');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('SEG_USUARIO')
            ->maxLength('SEG_USUARIO', 256)
            ->allowEmptyString('SEG_USUARIO', 'create');

        $validator
            ->scalar('NOMBRE')
            ->maxLength('NOMBRE', 256)
            ->requirePresence('NOMBRE', 'create')
            ->allowEmptyString('NOMBRE', false);

        $validator
            ->scalar('APELLIDO_1')
            ->maxLength('APELLIDO_1', 256)
            ->requirePresence('APELLIDO_1', 'create')
            ->allowEmptyString('APELLIDO_1', false);

        $validator
            ->scalar('APELLIDO_2')
            ->maxLength('APELLIDO_2', 256)
            ->allowEmptyString('APELLIDO_2');

        $validator
            ->scalar('NOMBRE_USUARIO')
            ->maxLength('NOMBRE_USUARIO', 256)
            ->requirePresence('NOMBRE_USUARIO', 'create')
            ->allowEmptyString('NOMBRE_USUARIO', false);

        $validator
            ->scalar('CONTRASEÑA')
            ->maxLength('CONTRASEÑA', 256)
            ->requirePresence('CONTRASEÑA', 'create')
            ->allowEmptyString('CONTRASEÑA', false);

        $validator
            ->scalar('CORREO')
            ->maxLength('CORREO', 256)
            ->requirePresence('CORREO', 'create')
            ->allowEmptyString('CORREO', false);

        $validator
            ->scalar('NUMERO_TELEFONO')
            ->maxLength('NUMERO_TELEFONO', 256)
            ->requirePresence('NUMERO_TELEFONO', 'create')
            ->allowEmptyString('NUMERO_TELEFONO', false);

        $validator
            ->scalar('NACIONALIDAD')
            ->maxLength('NACIONALIDAD', 256)
            ->requirePresence('NACIONALIDAD', 'create')
            ->allowEmptyString('NACIONALIDAD', false);

        $validator
            ->scalar('ACTIVO')
            ->maxLength('ACTIVO', 1)
            ->allowEmptyString('ACTIVO');

        $validator
            ->scalar('ESTUDIANTE')
            ->maxLength('ESTUDIANTE', 1)
            ->allowEmptyString('ESTUDIANTE');

        return $validator;
    }
}
