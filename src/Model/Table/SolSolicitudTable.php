<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * SolSolicitud Model
 *
 * @method \App\Model\Entity\SolSolicitud get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolSolicitud newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolSolicitud[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolSolicitud|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolSolicitud saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolSolicitud patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolSolicitud[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolSolicitud findOrCreate($search, callable $callback = null, $options = [])
 */
class SolSolicitudTable extends Table
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

        $this->setTable('sol_solicitud');
        $this->setDisplayField('SEG_USUARIO');
        $this->setPrimaryKey(['SEG_USUARIO', 'PRO_CURSO']);
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
            ->scalar('RESULTADO')
            ->maxLength('RESULTADO', 9)
            ->allowEmptyString('RESULTADO');

        $validator
            ->scalar('ACTIVO')
            ->maxLength('ACTIVO', 1)
            ->allowEmptyString('ACTIVO');

        return $validator;
    }
	
	/**
	* getApplication
	* @author Esteban Rojas
	* Dummy function. Obtains an application 
	* @param user_id 
	* @param course_id
	* @return object with the user's name, result and course's name of the application
	*/
	public function getApplication($user_id,$course_id)
	{
		$connect = ConnectionManager::get('default');
        $application = $connect->execute(
            "SELECT P.NOMBRE, US.NOMBRE_USUARIO, S.RESULTADO FROM SOL_SOLICITUD S, PRO_CURSO P, SEG_USUARIO US 
			WHERE S.SEG_USUARIO = '$user_id' AND S.PRO_CURSO = '$course_id' AND P.PRO_CURSO = S.PRO_CURSO AND US.SEG_USUARIO = S.SEG_USUARIO"
        )->fetchAll('assoc');

        return (object)$application[0];
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
            "SELECT S.SEG_USUARIO, S.PRO_CURSO, S.RESULTADO, P.NOMBRE FROM SOL_SOLICITUD S JOIN PRO_CURSO P
             ON S.PRO_CURSO = P.PRO_CURSO
             WHERE S.SEG_USUARIO = '$user_id' AND S.ACTIVO = '1' AND P.ACTIVO = '1'"
        )->fetchAll('assoc');

        return $user_applications;
    }

    /**
     * getPercentage
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Gets the percentage of answered questions.
     * @param int $course, it's the course id.
     * @param int $student, it's the user id.
     * @return double the percentage of answered questions.
     */
    public function getPercentage($course,$student)
    {
        $connect= ConnectionManager::get('default');
        $result= $connect->execute(
            "SELECT 
                (
                    SELECT 100/COUNT(*) 
                    FROM SOL_CONTIENE INNER JOIN PRO_CURSO 
                    ON SOL_CONTIENE.SOL_FORMULARIO = PRO_CURSO.SOL_FORMULARIO
                    WHERE PRO_CURSO = $course
                )
                *
                (
                    (
                        SELECT COUNT(*) 
                        FROM SOL_TEXTO_CORTO 
                        WHERE PRO_CURSO = $course AND SEG_USUARIO = $student
                    )
                    +
                    (
                        SELECT COUNT(*) 
                        FROM SOL_NUMERO 
                        WHERE PRO_CURSO = $course AND SEG_USUARIO = $student
                    )
                    + 
                    (
                        SELECT COUNT(*) 
                        FROM SOL_TEXTO_MEDIO
                        WHERE PRO_CURSO = $course AND SEG_USUARIO = $student
                    )
                    +
                    (
                        SELECT COUNT(*) 
                        FROM SOL_TEXTO_LARGO 
                        WHERE PRO_CURSO = $course AND SEG_USUARIO = $student
                    )
                    +
                    (
                        SELECT COUNT(*) 
                        FROM SOL_FECHA 
                        WHERE PRO_CURSO = $course AND SEG_USUARIO = $student
                    )
                )
            AS PORCENTAGE
            FROM DUAL"
        )->fetchAll('assoc');
        return $result[0]['PORCENTAGE'];
    }
}
