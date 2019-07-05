<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * SolFecha Model
 *
 * @method \App\Model\Entity\SolFecha get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolFecha newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolFecha[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolFecha|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolFecha saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolFecha patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolFecha[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolFecha findOrCreate($search, callable $callback = null, $options = [])
 */
class SolFechaTable extends Table
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

        $this->setTable('sol_fecha');
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
            ->dateTime('RESPUESTA')
            ->requirePresence('RESPUESTA', 'create')
            ->allowEmptyDateTime('RESPUESTA', false);

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
            "SELECT RESPUESTA FROM SOL_FECHA
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
                "UPDATE SOL_FECHA SET RESPUESTA = '$answer'
                WHERE SEG_USUARIO = $user AND PRO_CURSO = $course AND SOL_PREGUNTA = $question"
            );
        }else{
            $connect->execute(
                "INSERT INTO SOL_FECHA 
                VALUES($user,$course,$question,'$answer','1')"
            );
        }
        $connect->execute(
            "COMMIT"
        );
    }

    /**
     * insertarFecha
     * @author Nathan González Herrera
     *      
     * Insert the answer of a date question type
     * @param int $usuario the identification of an user in the database
     * @param int $curso the identification of a course in the database
     * @param int $idpregunta the identification of the question in the database
     * @param int $numPregunta the number of the question into the form 
     * @param int $respuesta the answer of the question
     */
    public function insertarFecha($usuario, $curso, $idpregunta, $numPregunta, $respuesta){
        $connect= ConnectionManager::get('default');
        $connect->execute(
            "INSERT INTO SOL_FECHA(SEG_USUARIO, PRO_CURSO, SOL_PREGUNTA, NUMERO_RESPUESTA, RESPUESTA)
             VALUES ('$usuario', '$curso', '$idpregunta', '$numPregunta', '$respuesta')"
        );
        $connect->execute(
            "COMMIT"
        );
    }

    /**
     * actualizarFecha
     * @author Nathan González Herrera
     *      
     * Update the answer of a date question type
     * @param int $usuario the identification of an user in the database
     * @param int $curso the identification of a course in the database
     * @param int $pregunta the identification of the question in the database
     * @param int $respuesta the answer of the question
     */
    public function actualizarFecha($usuario, $curso, $pregunta, $respuesta){
        $connect= ConnectionManager::get('default');
        $connect->execute(
            "UPDATE SOL_FECHA
             SET RESPUESTA = '$respuesta'
             WHERE SEG_USUARIO = '$usuario'
             AND PRO_CURSO = '$curso'
             AND SOL_PREGUNTA = '$pregunta'"
        );
        $connect->execute(
            "COMMIT"
        );
    }
}
