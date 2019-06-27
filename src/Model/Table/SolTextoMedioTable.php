<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * SolTextoMedio Model
 *
 * @method \App\Model\Entity\SolTextoMedio get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolTextoMedio newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolTextoMedio[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolTextoMedio|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolTextoMedio saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolTextoMedio patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolTextoMedio[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolTextoMedio findOrCreate($search, callable $callback = null, $options = [])
 */
class SolTextoMedioTable extends Table
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

        $this->setTable('sol_texto_medio');
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
            ->maxLength('RESPUESTA', 255)
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
            "SELECT RESPUESTA FROM SOL_TEXTO_MEDIO
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
                "UPDATE SOL_TEXTO_MEDIO SET RESPUESTA = '$answer'
                WHERE SEG_USUARIO = $user AND PRO_CURSO = $course AND SOL_PREGUNTA = $question"
            );
        }else{
            $connect->execute(
                "INSERT INTO SOL_TEXTO_MEDIO 
                VALUES($user,$course,$question,'$answer','1')"
            );
        }
        $connect->execute(
            "COMMIT"
        );
    }

    public function insertarTextoMediano($usuario, $curso, $idpregunta, $numPregunta, $respuesta){
        $connect= ConnectionManager::get('default');
        $connect->execute(
            "INSERT INTO SOL_TEXTO_MEDIO(SEG_USUARIO, PRO_CURSO, SOL_PREGUNTA, NUMERO_RESPUESTA, RESPUESTA)
             VALUES ('$usuario', '$curso', '$idpregunta', '$numPregunta', '$respuesta')"
        );
        $connect->execute(
            "COMMIT"
        );
    }

    public function actualizarTextoMediano($usuario, $curso, $pregunta, $respuesta){
        $connect= ConnectionManager::get('default');
        $connect->execute(
            "UPDATE SOL_TEXTO_MEDIO
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
