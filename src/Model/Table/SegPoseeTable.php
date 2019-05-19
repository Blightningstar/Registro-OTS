<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SegPosee Model
 *
 * @method \App\Model\Entity\SegPosee get($primaryKey, $options = [])
 * @method \App\Model\Entity\SegPosee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SegPosee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SegPosee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SegPosee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SegPosee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SegPosee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SegPosee findOrCreate($search, callable $callback = null, $options = [])
 */
class SegPoseeTable extends Table
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

        $this->setTable('seg_posee');
        $this->setDisplayField('SEG_ROL');
        $this->setPrimaryKey(['SEG_ROL', 'SEG_PERMISO']);
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
            ->integer('SEG_ROL')
            ->allowEmptyString('SEG_ROL', 'create');

        $validator
            ->integer('SEG_PERMISO')
            ->allowEmptyString('SEG_PERMISO', 'create');

        return $validator;
    }
}
