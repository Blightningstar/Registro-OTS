<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProPrograma Model
 *
 * @method \App\Model\Entity\ProPrograma get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProPrograma newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProPrograma[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProPrograma|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProPrograma saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProPrograma patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProPrograma[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProPrograma findOrCreate($search, callable $callback = null, $options = [])
 */
class ProProgramaTable extends Table
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

        $this->setTable('pro_programa');
        $this->setDisplayField('PRO_PROGRAMA');
        $this->setPrimaryKey('PRO_PROGRAMA');
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
            ->scalar('PRO_PROGRAMA')
            ->maxLength('PRO_PROGRAMA', 256)
            ->allowEmptyString('PRO_PROGRAMA', 'create');

        $validator
            ->scalar('NOMBRE')
            ->maxLength('NOMBRE', 256)
            ->requirePresence('NOMBRE', 'create')
            ->allowEmptyString('NOMBRE', false);

        $validator
            ->scalar('IDIOMA')
            ->maxLength('IDIOMA', 256)
            ->requirePresence('IDIOMA', 'create')
            ->allowEmptyString('IDIOMA', false);

        $validator
            ->integer('CREDITAJE')
            ->requirePresence('CREDITAJE', 'create')
            ->allowEmptyString('CREDITAJE', false);

        $validator
            ->scalar('PAIS')
            ->maxLength('PAIS', 256)
            ->requirePresence('PAIS', 'create')
            ->allowEmptyString('PAIS', false);

        $validator
            ->scalar('ACTIVO')
            ->maxLength('ACTIVO', 1)
            ->allowEmptyString('ACTIVO');

        return $validator;
    }
}
