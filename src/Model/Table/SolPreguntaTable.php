<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SolPregunta Model
 *
 * @method \App\Model\Entity\SolPreguntum get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolPreguntum newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolPreguntum[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolPreguntum|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolPreguntum saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolPreguntum patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolPreguntum[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolPreguntum findOrCreate($search, callable $callback = null, $options = [])
 */
class SolPreguntaTable extends Table
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

        $this->setTable('sol_pregunta');
        $this->setDisplayField('SOL_PREGUNTA');
        $this->setPrimaryKey('SOL_PREGUNTA');
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
            ->integer('SOL_PREGUNTA')
            ->allowEmptyString('SOL_PREGUNTA', 'create');

        $validator
            ->scalar('DESCRIPCION_ESP')
            ->maxLength('DESCRIPCION_ESP', 256)
            ->allowEmptyString('DESCRIPCION_ESP');

        $validator
            ->scalar('DESCRIPCION_ING')
            ->maxLength('DESCRIPCION_ING', 256)
            ->requirePresence('DESCRIPCION_ING', 'create')
            ->allowEmptyString('DESCRIPCION_ING', false);

        $validator
            ->integer('TIPO')
            ->requirePresence('TIPO', 'create')
            ->allowEmptyString('TIPO', false);

        $validator
            ->scalar('REQUERIDO')
            ->maxLength('REQUERIDO', 1)
            ->requirePresence('REQUERIDO', 'create')
            ->allowEmptyString('REQUERIDO', false);

        $validator
            ->scalar('ACTIVO')
            ->maxLength('ACTIVO', 1)
            ->allowEmptyString('ACTIVO');

        return $validator;
    }
}
