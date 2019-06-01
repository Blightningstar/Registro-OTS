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

        return $validator;
    }
    
    /**
     * getUserApplications
     * @author Esteban Rojas 
     * Obtains all the user's applications
     * @param user_id The user whose applications are required.
     * @return array with all the user applications. Can be empty
     */
    public function getUserApplications($user_id)
    {
        $connect = ConnectionManager::get('default');
        $user_applications = $connect->execute(
            "SELECT S.RESULTADO, P.NOMBRE FROM SOL_SOLICITUD S JOIN PRO_CURSO P
             ON S.PRO_CURSO = P.PRO_CURSO
             WHERE S.SEG_USUARIO = '$user_id' AND S.ACTIVO = '1' AND P.ACTIVO = '1'"
        )->fetchAll('assoc');

        return $user_applications;
    }
}
