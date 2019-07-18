<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

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
            ->requirePresence('DESCRIPCION_ESP', 'create')
            ->allowEmptyString('DESCRIPCION_ESP', false);

        $validator
            ->scalar('DESCRIPCION_ING')
            ->maxLength('DESCRIPCION_ING', 256)
            ->requirePresence('DESCRIPCION_ING', 'create')
            ->allowEmptyString('DESCRIPCION_ING', false);

        $validator
            ->integer('TIPO')
            ->allowEmptyString('TIPO');

        $validator
            ->scalar('REQUERIDO')
            ->maxLength('REQUERIDO', 1)
            ->allowEmptyString('REQUERIDO');

        $validator
            ->scalar('ACTIVO')
            ->maxLength('ACTIVO', 1)
            ->allowEmptyString('ACTIVO');

        return $validator;
    }

    /**
     *  Insert new preguntas to database
     *  @author Joel Chaves
     *  @param string $dEsp, it's the question's description in spanish
     *  @param string $dIng, it's the question's description in english
     *  @param string $tipo, it's the question's type
     *  @param string $req, it's the question's type required atributte
     *  @param string $act, it's the question's type active attribute, its state
     *  @return 1 when succeded
     */
    public function insertarPregunta($dIng, $tipo, $req, $act)
    {
        $connet = ConnectionManager::get('default');
        $result = $connet->execute("INSERT INTO sol_pregunta VALUES (1, '$dIng', $tipo, $req, $act)");
        $connet->execute(
            "COMMIT"
        );
        return 1;
    }

    /**
     *  Update new preguntas to database
     *  @author Anyelo Lobo
     *  @param int $idPreg, the question ID
     *  @param string $dEsp, it's the question's description in spanish
     *  @param string $dIng, it's the question's description in english
     *  @param string $tipo, it's the question's type
     *  @param string $req, it's the question's type required atributte
     *  @param string $act, it's the question's type active attribute, its state
     *  @return 1 when succeded
     */
    public function editarPregunta($idPreg, $dIng, $tipo, $req, $act)
    {
        $connet = ConnectionManager::get('default');
        $result = $connet->execute("UPDATE sol_pregunta 
        SET DESCRIPCION_ING = '$dIng', TIPO = '$tipo', REQUERIDO = '$req', ACTIVO = '$act'
        WHERE SOL_PREGUNTA = '$idPreg'");
        $connet->execute(
            "COMMIT"
        );
        return 1;
    }

     /**
     *  Return the max integer value from SOL_PREGUNTA 
     *  @author Joel Chaves
     *  @return the max integer value from the column sol_pregunta from SOL_PREGUNTA table, null if there's nothing in the table
     */
    public function returnMaxSolPregunta ()
    {

        $connet = ConnectionManager::get('default');
        $result = $connet->execute("SELECT MAX(SOL_PREGUNTA) FROM sol_pregunta");
        $result = $result->fetchAll('assoc');

        $maximo=$result[0]['MAX(SOL_PREGUNTA)'];
       
        if ($maximo==null)
        {

            $result=0;
        }else
        {
            $result=$maximo+1;
        }
        debug($maximo);
        debug($result);
        return $result;
    }

     /**
     *  Logically activates and deactivates a question from the datebase, it changes the value ACTIVO from 0 to 1 and viceversa
     *  @author Joel Chaves
     *  @param int $id, it's the question identifier
     *  @return 1 when succeded
     */
     public function desactivarPregunta ($id)
    {

        $connet = ConnectionManager::get('default');
        $result = $connet->execute("UPDATE sol_pregunta SET ACTIVO=1-ACTIVO WHERE SOL_PREGUNTA= $id");
        $connet->execute(
            "COMMIT"
        );
        return 1;
    }

    public function getPreguntas(){
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT * FROM SOL_PREGUNTA"
        )->fetchAll('assoc');
        return $result;
    }

    /**
    * 
    * @author AnyeloLobo <yeloanlo@gmail.com>
    * 
    * 
    * @param string $descrIng, is the question description in English.
    * @return string the restauration code of the user.
    */
    public function getQuestID($descrIng){
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT SOL_PREGUNTA FROM SOL_PREGUNTA
             WHERE DESCRIPCION_ING = '$descrIng'"
        )->fetchAll('assoc');
        return $result[0]['SOL_PREGUNTA'];
    }

    /**
    * 
    * @author Anyelo Lobo <yeloanlo@gmail.com>
    * 
    *  Insert the options for the select question
    * @param $idPreg, is the question id.
    * @param $options is the array of options inserted by user
    */
    public function insertOptions($idPreg, $options){
        $connet = ConnectionManager::get('default');
        foreach ($options as $option) {
            $result = $connet->execute("INSERT INTO sol_opciones VALUES (1, $idPreg, '$option', '$option')");
        }

        $connet->execute(
            "COMMIT"
        );
        return 1;
    }

    /**
    * 
    * @author Anyelo Lobo <yeloanlo@gmail.com>
    * 
    * Delete options befor adding the new ones
    * @param $idPreg, is the question id.
    * @param $options is the array of options inserted by user
    */
    public function deleteOptions($idPreg){
        $connect = ConnectionManager::get('default');
        $connect->execute(
            "DELETE FROM SOL_OPCIONES
            WHERE SOL_PREGUNTA = '$idPreg' "
        );

        $connect->execute(
            "COMMIT"
        );
        return 1;
    }

    /**
    * 
    * @author Anyelo Lobo <yeloanlo@gmail.com>
    * 
    * 
    * @param $idPreg, is the question id.
    * 
    */
    public function getOptions($idPreg){
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT DESCRIPCION_ING FROM SOL_OPCIONES WHERE SOL_PREGUNTA = '$idPreg' "
        )->fetchAll('assoc');
        return $result;
    }

    /** 
     * getDescripcion
     * @author Nathan González Herrera
     * 
     * Return the description of a given question.
     * @param $idPregunta, is the question id.
     */
    public function getDescripcion($idPregunta){
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT DESCRIPCION_ING 
             FROM SOL_PREGUNTA
             WHERE SOL_PREGUNTA = '$idPregunta' "
        )->fetchAll('assoc');
        return $result[0]['DESCRIPCION_ING'];
    }
}
