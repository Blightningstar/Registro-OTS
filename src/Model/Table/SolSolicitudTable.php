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
                    SELECT  100/COUNT(*) 
                    FROM    SOL_CONTIENE, PRO_CURSO, SOL_PREGUNTA
                    WHERE   SOL_CONTIENE.SOL_FORMULARIO = PRO_CURSO.SOL_FORMULARIO AND
                            SOL_CONTIENE.SOL_PREGUNTA = SOL_PREGUNTA.SOL_PREGUNTA AND 
                            SOL_PREGUNTA.REQUERIDO = 1 AND  
                            PRO_CURSO = $course
                )
                *
                (
                    (
                        SELECT  COUNT(*) 
                        FROM    SOL_TEXTO_CORTO, SOL_PREGUNTA
                        WHERE   SOL_TEXTO_CORTO.SOL_PREGUNTA = SOL_PREGUNTA.SOL_PREGUNTA AND
                                SOL_PREGUNTA.REQUERIDO = 1 AND
                                PRO_CURSO = $course AND 
                                SEG_USUARIO = $student
                    )
                    +
                    (
                        SELECT  COUNT(*) 
                        FROM    SOL_NUMERO, SOL_PREGUNTA
                        WHERE   SOL_NUMERO.SOL_PREGUNTA = SOL_PREGUNTA.SOL_PREGUNTA AND
                                SOL_PREGUNTA.REQUERIDO = 1 AND 
                                PRO_CURSO = $course AND 
                                SEG_USUARIO = $student
                    )
                    + 
                    (
                        SELECT COUNT(*) 
                        FROM SOL_TEXTO_MEDIO, SOL_PREGUNTA
                        WHERE   SOL_TEXTO_MEDIO.SOL_PREGUNTA = SOL_PREGUNTA.SOL_PREGUNTA AND
                                SOL_PREGUNTA.REQUERIDO = 1 AND  PRO_CURSO = $course AND SEG_USUARIO = $student
                    )
                    +
                    (
                        SELECT COUNT(*) 
                        FROM SOL_TEXTO_LARGO, SOL_PREGUNTA
                        WHERE   SOL_TEXTO_LARGO.SOL_PREGUNTA = SOL_PREGUNTA.SOL_PREGUNTA AND
                                SOL_PREGUNTA.REQUERIDO = 1 AND  PRO_CURSO = $course AND SEG_USUARIO = $student
                    )
                    +
                    (
                        SELECT COUNT(*) 
                        FROM SOL_FECHA, SOL_PREGUNTA
                        WHERE   SOL_FECHA.SOL_PREGUNTA = SOL_PREGUNTA.SOL_PREGUNTA AND
                                SOL_PREGUNTA.REQUERIDO = 1 AND  PRO_CURSO = $course AND SEG_USUARIO = $student
                    )
                )
            AS PORCENTAGE
            FROM DUAL"
        )->fetchAll('assoc');
        return min($result[0]['PORCENTAGE'],100);
    }

    /**
     * crearSolicitud
     * @author Nathan González Herrera
     *      
     * Insert the new application into the database
     * @param int $usuarioId the identification of an user in the database
     * @param int $cursoId the identification of a course in the database
     */
    public function crearSolicitud($usuarioId, $cursoId){
        $connect= ConnectionManager::get('default');
        $connect->execute(
            "INSERT INTO SOL_SOLICITUD(SEG_USUARIO, PRO_CURSO)
             VALUES ('$usuarioId', '$cursoId')"
        );
        $connect->execute(
            "COMMIT"
        );
    }

    /**
     * existeSolicitud
     * @author Nathan González Herrera
     *      
     * If the application already exist in the database return 1 else return 0
     * @param int $usuarioId the identification of an user in the database
     * @param int $cursoId the identification of a course in the database
     * @return bool 0 if the application doen not exist and more than 0 if exist
     */
    public function existeSolicitud($usuarioId, $cursoId){
        $connect= ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT COUNT(*)
             FROM SOL_SOLICITUD
             WHERE SOL_SOLICITUD.SEG_USUARIO = '$usuarioId'
             AND SOL_SOLICITUD.PRO_CURSO = '$cursoId'"
        )->fetchAll('assoc');
        return $result[0]['COUNT(*)'];
    }

    /**
     * verSolicitud
     * @author Nathan González Herrera
     *      
     * Retrive all the answer of the application
     * @param int $usuarioId the identification of an user in the database
     * @param int $cursoId the identification of a course in the database
     * @return set of all the answers
     */
    public function verSolicitud($usuarioId, $cursoId){
        $connect= ConnectionManager::get('default');
        $textos = $connect->execute(
            "SELECT TC.NUMERO_RESPUESTA, TC.RESPUESTA
             FROM SOL_TEXTO_CORTO TC
             WHERE '$usuarioId' = TC.SEG_USUARIO AND TC.PRO_CURSO = '$cursoId'
             UNION
             SELECT TM.NUMERO_RESPUESTA, TM.RESPUESTA
             FROM SOL_TEXTO_MEDIO TM
             WHERE '$usuarioId' = TM.SEG_USUARIO AND TM.PRO_CURSO = '$cursoId'
             UNION
             SELECT TL.NUMERO_RESPUESTA, TL.RESPUESTA
             FROM SOL_TEXTO_LARGO TL
             WHERE '$usuarioId' = TL.SEG_USUARIO AND TL.PRO_CURSO = '$cursoId'
             ORDER BY 1 ASC"
        )->fetchAll('assoc');

        $fechas = $connect->execute(
            "SELECT F.NUMERO_RESPUESTA, F.RESPUESTA
             FROM SOL_FECHA F
             WHERE '$usuarioId' = F.SEG_USUARIO AND F.PRO_CURSO = '$cursoId'
             ORDER BY 1 ASC"
        )->fetchAll('assoc');

        $numeros = $connect->execute(
            "SELECT N.NUMERO_RESPUESTA, N.RESPUESTA
             FROM SOL_NUMERO N
             WHERE '$usuarioId' = N.SEG_USUARIO AND N.PRO_CURSO = '$cursoId'
             ORDER BY 1 ASC"
        )->fetchAll('assoc');

        $archivos = $connect->execute(
            "SELECT A.NUMERO_RESPUESTA, A.RESPUESTA
             FROM SOL_ARCHIVO A
             WHERE '$usuarioId' = A.SEG_USUARIO AND A.PRO_CURSO = '$cursoId'
             ORDER BY 1 ASC"
        )->fetchAll('assoc');

        $resultados = [];

        foreach($textos as $texto){
            $resultados[$texto['NUMERO_RESPUESTA']] = $texto['RESPUESTA'];
        }

        foreach($fechas as $fecha){
            $resultados[$fecha['NUMERO_RESPUESTA']] = $fecha['RESPUESTA'];
        }

        foreach($numeros as $numero){
            $resultados[$numero['NUMERO_RESPUESTA']] = $numero['RESPUESTA'];
        }

        foreach($archivos as $archivo){
            $resultados[$archivo['NUMERO_RESPUESTA']] = $archivo['RESPUESTA'];
        }

        ksort($resultados);
        
        return $resultados;
    }
}
