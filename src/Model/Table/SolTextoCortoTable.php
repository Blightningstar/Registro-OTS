<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * SolTextoCorto Model
 *
 * @method \App\Model\Entity\SolTextoCorto get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolTextoCorto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolTextoCorto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolTextoCorto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolTextoCorto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolTextoCorto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolTextoCorto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolTextoCorto findOrCreate($search, callable $callback = null, $options = [])
 */
class SolTextoCortoTable extends Table
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

        $this->setTable('sol_texto_corto');
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
            ->scalar('RESPUESTA')
            ->maxLength('RESPUESTA', 50)
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
            "SELECT RESPUESTA FROM SOL_TEXTO_CORTO
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
     * @param string $answer, the answer.
     */
    public function setAnswer($solicitude,$question,$answer){
        $user = $solicitude['SEG_USUARIO'];
        $course = $solicitude['PRO_CURSO'];
        $connect = ConnectionManager::get('default');
        if($this->getAnswer($solicitude,$question)){
            $connect->execute(
                "UPDATE SOL_TEXTO_CORTO SET RESPUESTA = '$answer'
                WHERE SEG_USUARIO = $user AND PRO_CURSO = $course AND SOL_PREGUNTA = $question"
            );
        }else{
            $connect->execute(
                "INSERT INTO SOL_TEXTO_CORTO 
                VALUES($user,$course,$question,'$answer','1')"
            );
        }
        $connect->execute(
            "COMMIT"
        );
    }

    /**
     * insertarTextoCorto
     * @author Nathan González Herrera
     *      
     * Insert the answer of a short text question type
     * @param int $usuario the identification of an user in the database
     * @param int $curso the identification of a course in the database
     * @param int $idpregunta the identification of the question in the database
     * @param int $numPregunta the number of the question into the form 
     * @param int $respuesta the answer of the question
     */
    public function insertarTextoCorto($usuario, $curso, $idpregunta, $numPregunta, $respuesta){
        $connect= ConnectionManager::get('default');
        $connect->execute(
            "INSERT INTO SOL_TEXTO_CORTO(SEG_USUARIO, PRO_CURSO, SOL_PREGUNTA, NUMERO_RESPUESTA, RESPUESTA)
             VALUES ('$usuario', '$curso', '$idpregunta', '$numPregunta', '$respuesta')"
        );
        $connect->execute(
            "COMMIT"
        );
    }

    /**
     * ActualizarTextoCorto
     * @author Nathan González Herrera
     *      
     * Update the answer of a short text question type
     * @param int $usuario the identification of an user in the database
     * @param int $curso the identification of a course in the database
     * @param int $pregunta the identification of the question in the database 
     * @param int $respuesta the answer of the question
     */
    public function actualizarTextoCorto($usuario, $curso, $pregunta, $respuesta){
        $connect= ConnectionManager::get('default');
        $connect->execute(
            "UPDATE SOL_TEXTO_CORTO
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
