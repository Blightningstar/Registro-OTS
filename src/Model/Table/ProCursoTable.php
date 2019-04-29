<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProCurso Model
 * @author Jason Zamora Trejos
 * @method \App\Model\Entity\ProCurso get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProCurso newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProCurso[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProCurso|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProCurso saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProCurso patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProCurso[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProCurso findOrCreate($search, callable $callback = null, $options = [])
 */
class ProCursoTable extends Table
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

        $this->setTable('pro_curso');
        $this->setDisplayField('PRO_CURSO');
        $this->setPrimaryKey('PRO_CURSO');
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
            ->integer('PRO_CURSO')
            ->allowEmptyString('PRO_CURSO', 'create');

        $validator
            ->scalar('SIGLA')
            ->maxLength('SIGLA', 8)
            ->requirePresence('SIGLA', 'create')
            ->allowEmptyString('SIGLA', false);

        $validator
            ->scalar('NOMBRE')
            ->maxLength('NOMBRE', 256)
            ->requirePresence('NOMBRE', 'create')
            ->allowEmptyString('NOMBRE', false);

        $validator
            ->date('FECHA_INICIO')
            ->allowEmptyDate('FECHA_INICIO');

        $validator
            ->date('FECHA_FINALIZACION')
            ->allowEmptyDate('FECHA_FINALIZACION');

        $validator
            ->date('FECHA_LIMITE')
            ->requirePresence('FECHA_LIMITE', 'create')
            ->allowEmptyDate('FECHA_LIMITE', false);

        $validator
            ->integer('CREDITOS')
            ->requirePresence('CREDITOS', 'create')
            ->allowEmptyString('CREDITOS', false);

        $validator
            ->scalar('IDIOMA')
            ->maxLength('IDIOMA', 256)
            ->requirePresence('IDIOMA', 'create')
            ->allowEmptyString('IDIOMA', false);

        $validator
            ->scalar('LOCACION')
            ->maxLength('LOCACION', 256)
            ->requirePresence('LOCACION', 'create')
            ->allowEmptyString('LOCACION', false);

        $validator
            ->nonNegativeInteger('ACTIVO')
            ->allowEmptyString('ACTIVO');

        $validator
            ->scalar('PRO_PROGRAMA')
            ->maxLength('PRO_PROGRAMA', 256)
            ->allowEmptyString('PRO_PROGRAMA');

        $validator
            ->scalar('SEG_USUARIO')
            ->maxLength('SEG_USUARIO', 256)
            ->allowEmptyString('SEG_USUARIO');

        $validator
            ->scalar('SOL_FORMULARIO')
            ->maxLength('SOL_FORMULARIO', 256)
            ->allowEmptyString('SOL_FORMULARIO');

        return $validator;
    }
}
