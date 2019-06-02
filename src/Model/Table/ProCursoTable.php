<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * ProCurso Model
 *
 * @method \App\Model\Entity\ProCurso get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProCurso newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProCurso[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProCurso|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProCurso saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProCurso patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProCurso[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProCurso findOrCreate($search, callable $callback = null, $options = [])
 */
class ProCursoTable extends Table
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

        $this->setTable('pro_curso');
        $this->setDisplayField('PRO_CURSO');
        $this->setPrimaryKey('PRO_CURSO');
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
            ->integer('PRO_CURSO')
            ->allowEmptyString('PRO_CURSO', 'create');

        $validator
            ->scalar('SIGLA')
            ->maxLength('SIGLA', 8)
            ->requirePresence('SIGLA', 'create')
            ->allowEmptyString('SIGLA', false);

        $validator
            ->scalar('NOMBRE')
            ->maxLength('NOMBRE', 64)
            ->requirePresence('NOMBRE', 'create')
            ->allowEmptyString('NOMBRE', false);

        $validator
            ->dateTime('FECHA_INICIO')
            ->requirePresence('FECHA_INICIO', 'create')
            ->allowEmptyDateTime('FECHA_INICIO', false);

        $validator
            ->dateTime('FECHA_FINALIZACION')
            ->requirePresence('FECHA_FINALIZACION', 'create')
            ->allowEmptyDateTime('FECHA_FINALIZACION', false);

        $validator
            ->dateTime('FECHA_LIMITE')
            ->requirePresence('FECHA_LIMITE', 'create')
            ->allowEmptyDateTime('FECHA_LIMITE', false);

        $validator
            ->integer('CREDITOS')
            ->allowEmptyString('CREDITOS');

        $validator
            ->scalar('IDIOMA')
            ->maxLength('IDIOMA', 16)
            ->requirePresence('IDIOMA', 'create')
            ->allowEmptyString('IDIOMA', false);

        $validator
            ->scalar('LOCACION')
            ->maxLength('LOCACION', 64)
            ->requirePresence('LOCACION', 'create')
            ->allowEmptyString('LOCACION', false);

        $validator
            ->scalar('ACTIVO')
            ->maxLength('ACTIVO', 1)
            ->allowEmptyString('ACTIVO');

        $validator
            ->scalar('PRO_PROGRAMA')
            ->maxLength('PRO_PROGRAMA', 3)
            ->allowEmptyString('PRO_PROGRAMA');

        $validator
            ->integer('SOL_FORMULARIO')
            ->allowEmptyString('SOL_FORMULARIO');

        $validator
            ->integer('SEG_USUARIO')
            ->allowEmptyString('SEG_USUARIO');

        return $validator;
    }

     /**
     * @author Jason Zamora Trejos
     * Logically delete a course
     * @param $id = the course ID
     * @return int $result is 1 if ACTIVE is 1, 0 if ACTIVE is 0
     */
    public function logicalDelete($id=null, $active=null)
    {
        $con = ConnectionManager::get('default');
        if($active == 1)
        {
            $result = $con->execute("update pro_curso set activo = '0' where PRO_CURSO = '$id'");
            return 0;
        }
        else
        {
            $result = $con->execute("update pro_curso set activo = '1' where PRO_CURSO = '$id'");
            return 1;
        }
    }
    
    
    /**
     * @author Jason Zamora Trejos
     * Checks if the course ID exists alredy in the database.
     * @param $lc_Id = The course ID 
     * @return int $lc_code = 1 if the parameter is found alredy in the data base, 0 if the parmeter it isn't
     */
     public function isUnique($lc_Id)
     {  
        $lc_code = "0";
        $lo_connet = ConnectionManager::get('default');
        $lc_result = $lo_connet->execute("SELECT SIGLA FROM pro_curso WHERE SIGLA = '$lc_Id'");
        $lc_result = $lc_result->fetchAll('assoc');
        if(empty($lc_result) == 0)
        {
            if($lc_result[0]["SIGLA"] == $lc_Id)
            {
               $lc_code = "1";
            }
        }
        return $lc_code;
      }  
}
