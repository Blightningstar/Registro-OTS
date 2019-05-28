<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * SolNumero Model
 *
 * @method \App\Model\Entity\SolNumero get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolNumero newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolNumero[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolNumero|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolNumero saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolNumero patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolNumero[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolNumero findOrCreate($search, callable $callback = null, $options = [])
 */
class SolNumeroTable extends Table
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

        $this->setTable('sol_numero');
        $this->setDisplayField('SEG_USUARIO');
        $this->setPrimaryKey(['SEG_USUARIO', 'PRO_CURSO', 'SOL_PREGUNTA']);
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
            ->integer('SEG_USUARIO')
            ->allowEmptyString('SEG_USUARIO', 'create');

        $validator
            ->integer('PRO_CURSO')
            ->allowEmptyString('PRO_CURSO', 'create');

        $validator
            ->integer('SOL_PREGUNTA')
            ->allowEmptyString('SOL_PREGUNTA', 'create');

        $validator
            ->integer('RESPUESTA')
            ->requirePresence('RESPUESTA', 'create')
            ->allowEmptyString('RESPUESTA', false);

        $validator
            ->scalar('ACTIVO')
            ->maxLength('ACTIVO', 1)
            ->allowEmptyString('ACTIVO');

        return $validator;
    }
    /**
     * getAnswer
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Get the answer of the solicitude question.
     * @param int[] $solicitude, the id of the entity solicitude.
     * @param int $question, the id of the entity question.
     * @return string the answer.
     */
    public function getAnswer($solicitude,$question){
        $user = $solicitude['SEG_USUARIO'];
        $course = $solicitude['PRO_CURSO'];
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT RESPUESTA FROM SOL_NUMERO
             WHERE SEG_USUARIO = $user AND PRO_CURSO = $course AND SOL_PREGUNTA = $question "
        )->fetchAll('assoc');
        if($result){
            return $result['0']['RESPUESTA'];
        }else{
            return null;
        }
    }

    /**
     * setAnswer
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Set the answer of the solicitude question.
     * @param int[] $solicitude, the id of the entity solicitude.
     * @param int $question, the id of the entity question.
     * @param int $answer, the answer.
     */
    public function setAnswer($solicitude,$question,$answer){
        $user = $solicitude['SEG_USUARIO'];
        $course = $solicitude['PRO_CURSO'];
        $connect = ConnectionManager::get('default');
        if($this->getAnswer($solicitude,$question)){
            $connect->execute(
                "UPDATE SOL_NUMERO SET RESPUESTA = $answer
                WHERE SEG_USUARIO = $user AND PRO_CURSO = $course AND SOL_PREGUNTA = $question"
            );
        }else{
            $connect->execute(
                "INSERT INTO SOL_NUMERO 
                VALUES($user,$course,$question,$answer,'1')"
            );
        }
        $connect->execute(
            "COMMIT"
        );
    }
}
