<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * SolOpciones Model
 *
 * @method \App\Model\Entity\SolOpcione get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolOpcione newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolOpcione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolOpcione|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolOpcione saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolOpcione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolOpcione[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolOpcione findOrCreate($search, callable $callback = null, $options = [])
 */
class SolOpcionesTable extends Table
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

        $this->setTable('sol_opciones');
        $this->setDisplayField('SOL_OPCIONES');
        $this->setPrimaryKey(['SOL_OPCIONES', 'SOL_PREGUNTA']);
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
            ->integer('SOL_OPCIONES')
            ->allowEmptyString('SOL_OPCIONES', 'create');

        $validator
            ->integer('SOL_PREGUNTA')
            ->allowEmptyString('SOL_PREGUNTA', 'create');

        $validator
            ->scalar('DESCRIPCION_ESP')
            ->maxLength('DESCRIPCION_ESP', 256)
            ->requirePresence('DESCRIPCION_ESP', 'create')
            ->allowEmptyString('DESCRIPCION_ESP', false);

        $validator
            ->scalar('DESCRIPCION_ING')
            ->maxLength('DESCRIPCION_ING', 256)
            ->requirePresence('DESCRIPCION_ING', 'create')
            ->allowEmptyString('DESCRIPCION_ING', false);

        return $validator;
    }

    /**
     * getOpciones
     * @author Nathan González Herrera
     *      
     * Retrive all the options for some question
     * @param int $preguntaId the identification of a question in the database
     * @return set of all the options to that question
     */
    public function getOpciones($preguntaId){
        $connect= ConnectionManager::get('default');
        $results = $connect->execute(
            "SELECT DESCRIPCION_ING
             FROM SOL_OPCIONES
             WHERE SOL_PREGUNTA = '$preguntaId'
             ORDER BY SOL_OPCIONES"
        )->fetchAll('assoc');

        $opciones = [];
        for($iterator = 0; $iterator < sizeof($results); ++$iterator){
            $opciones[$results[$iterator]['DESCRIPCION_ING']] = $results[$iterator]['DESCRIPCION_ING'];
        }

        return $opciones;
    }
}
