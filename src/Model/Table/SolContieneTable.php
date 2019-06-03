<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SolContiene Model
 *
 * @method \App\Model\Entity\SolContiene get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolContiene newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolContiene[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolContiene|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolContiene saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolContiene patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolContiene[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolContiene findOrCreate($search, callable $callback = null, $options = [])
 */
class SolContieneTable extends Table
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

        $this->setTable('sol_contiene');
        $this->setDisplayField('SOL_PREGUNTA');
        $this->setPrimaryKey(['SOL_PREGUNTA', 'SOL_FORMULARIO']);
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
            ->integer('SOL_FORMULARIO')
            ->allowEmptyString('SOL_FORMULARIO', 'create');

        $validator
            ->integer('NUMERO_PREGUNTA')
            ->requirePresence('NUMERO_PREGUNTA', 'create')
            ->allowEmptyString('NUMERO_PREGUNTA', false);

        return $validator;
    }
}
