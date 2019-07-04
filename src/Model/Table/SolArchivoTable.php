<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * SolArchivo Model
 *
 * @method \App\Model\Entity\SolArchivo get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolArchivo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolArchivo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolArchivo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolArchivo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolArchivo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolArchivo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolArchivo findOrCreate($search, callable $callback = null, $options = [])
 */
class SolArchivoTable extends Table
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

        $this->setTable('sol_archivo');
        $this->setDisplayField('SEG_USUARIO');
        $this->setPrimaryKey(['SEG_USUARIO', 'PRO_CURSO', 'SOL_PREGUNTA', 'NUMERO_RESPUESTA']);
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
            ->integer('NUMERO_RESPUESTA')
            ->allowEmptyString('NUMERO_RESPUESTA', 'create');

        $validator
            ->scalar('RESPUESTA')
            ->maxLength('RESPUESTA', 128)
            ->allowEmptyString('RESPUESTA');

        return $validator;
    }

    /**
     * insertarArchivo
     * @author Nathan González Herrera
     *      
     * Insert the answer of a file question type
     * @param int $usuario the identification of an user in the database
     * @param int $curso the identification of a course in the database
     * @param int $idpregunta the identification of the question in the database
     * @param int $numPregunta the number of the question into the form
     * @param int $filepath the path of the file
     */
    public function insertarArchivo($usuario, $curso, $idpregunta, $numPregunta, $filepath){
        $connect= ConnectionManager::get('default');
        $connect->execute(
            "INSERT INTO SOL_ARCHIVO(SEG_USUARIO, PRO_CURSO, SOL_PREGUNTA, NUMERO_RESPUESTA, RESPUESTA)
             VALUES ('$usuario', '$curso', '$idpregunta', '$numPregunta', '$filepath')"
        );
        $connect->execute(
            "COMMIT"
        );
    }

    /**
     * actualizarArchivo
     * @author Nathan González Herrera
     *      
     * Update the answer of a file question type
     * @param int $usuario the identification of an user in the database
     * @param int $curso the identification of a course in the database
     * @param int $pregunta the identification of the question in the database
     * @param int $filepath the path of the answer file
     */
    public function actualizarArchivo($usuario, $curso, $pregunta, $filepath){
        $connect= ConnectionManager::get('default');
        $connect->execute(
            "UPDATE SOL_ARCHIVO
             SET RESPUESTA = '$filepath'
             WHERE SEG_USUARIO = '$usuario'
             AND PRO_CURSO = '$curso'
             AND SOL_PREGUNTA = '$pregunta'"
        );
        $connect->execute(
            "COMMIT"
        );
    }
}
