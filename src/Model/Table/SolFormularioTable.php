<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * SolFormulario Model
 *
 * @method \App\Model\Entity\SolFormulario get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolFormulario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolFormulario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolFormulario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolFormulario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolFormulario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolFormulario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolFormulario findOrCreate($search, callable $callback = null, $options = [])
 */
class SolFormularioTable extends Table
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

        $this->setTable('sol_formulario');
        $this->setDisplayField('SOL_FORMULARIO');
        $this->setPrimaryKey('SOL_FORMULARIO');
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
            ->integer('SOL_FORMULARIO')
            ->allowEmptyString('SOL_FORMULARIO', 'create');

        $validator
            ->scalar('ACTIVO')
            ->maxLength('ACTIVO', 1)
            ->allowEmptyString('ACTIVO');

        $validator
            ->scalar('NOMBRE')
            ->maxLength('NOMBRE', 20)
            ->requirePresence('NOMBRE', 'create')
            ->allowEmptyString('NOMBRE', false);

        return $validator;
    }

    public function getPreguntasContiene($id)
    {
        $connect= ConnectionManager::get('default');
        $result= $connect->execute("SELECT * FROM SOL_PREGUNTA FULL OUTER JOIN SOL_CONTIENE ON SOL_PREGUNTA.SOL_PREGUNTA= SOL_CONTIENE.SOL_PREGUNTA
            WHERE SOL_FORMULARIO=$id ORDER BY NUMERO_PREGUNTA")->fetchAll('assoc');
        return $result;
    }

    /**
     * 
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Get the restauration code from the user known by his $email.
     * @param string $email, it's the user identificator.
     * @return string the restauration code of the user.
     */
    public function getFormID($nombre){
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT SOL_FORMULARIO FROM SOL_FORMULARIO
             WHERE NOMBRE = '$nombre'"
        )->fetchAll('assoc');
        return $result[0]['SOL_FORMULARIO'];
    }



    /**
     *  deactivates a Form on the database
     *  @author Joel Chaves
     *  @param int $id, it's the form identifier
     *  @return 1 when succeded
     */
    public function desactivarFormulario ($id)
    {

        $connet = ConnectionManager::get('default');
        $result = $connet->execute("UPDATE sol_formulario SET ACTIVO=1-ACTIVO WHERE sol_formulario= $id");
        $connet->execute(
            "COMMIT"
        );
        return 1;
    }


     /**
     *  deletes a Form from the database
     *  @author Joel Chaves
     *  @param int $id, it's the form identifier
     *  @return 1 when succeded
     */
    public function borrarFormulario ($id)
    {

        $connect = ConnectionManager::get('default');
        $result = $connect->execute("DELETE FROM SOL_FORMULARIO WHERE SOL_FORMULARIO =$id");
        $connect->execute(
            "COMMIT"
        );
        return 1;
}

    /**
     * getPreguntasFormulario
     * @author Nathan González Herrera
     *      
     * Get all the answers of a given form
     * @param int $id Form identification in the database
     */
    public function getPreguntasFormulario($id){
        $connect= ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT CO.NUMERO_PREGUNTA , P.*
             FROM PRO_CURSO C, SOL_FORMULARIO F, SOL_CONTIENE CO, SOL_PREGUNTA P
             WHERE '$id' = C.PRO_CURSO
             AND C.SOL_FORMULARIO = F.SOL_FORMULARIO
             AND F.SOL_FORMULARIO = CO.SOL_FORMULARIO
             AND CO.SOL_PREGUNTA = P.SOL_PREGUNTA
             ORDER BY CO.NUMERO_PREGUNTA ASC"
        )->fetchAll('assoc');
        return $result;
    }
    
    /**
     * 
     * @author Anyelo Lobo <yeloanlo@gmail.com>
     * 
     * Get the containing questions in the form
     * @param int $SOL_FORMULARIO, it's the form identificator.
     * @return array with all the containing questions
     */
    public function getContainingQuestions($idForm){
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT DISTINCT DESCRIPCION_ING, NUMERO_PREGUNTA, SOL_CONTIENE.SOL_PREGUNTA, SOL_FORMULARIO 
            FROM SOL_PREGUNTA
            INNER JOIN SOL_CONTIENE
            ON SOL_PREGUNTA.SOL_PREGUNTA = SOL_CONTIENE.SOL_PREGUNTA
            WHERE SOL_CONTIENE.SOL_FORMULARIO = '$idForm'
            ORDER BY SOL_CONTIENE.NUMERO_PREGUNTA"
        )->fetchAll('assoc');
        return $result;
    }

    /**
     * 
     * @author Anyelo Lobo <yeloanlo@gmail.com>
     * 
     * Delete the containing questions of the form
     * @param int $formID, it's the form identificator.
     * @param int $questID, the question identificator.
     */
    public function deleteFormQuestion($formID, $questID){
        $connect = ConnectionManager::get('default');
        $connect->execute(
            "DELETE FROM SOL_CONTIENE
            WHERE SOL_FORMULARIO = '$formID' AND SOL_PREGUNTA = '$questID'"
        );
        $connect->execute("COMMIT");

        return 1;
    }
}