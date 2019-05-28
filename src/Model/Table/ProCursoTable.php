<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

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
     * insertCourse
     *
     * Saves the data in the database.
     * @author Jason Zamora Trejos
     * @param array $config The configuration for the Table.
     * @return true
     */
    public function insertCourse(array $course)
    {
        $name = $course['NOMBRE'];
        $startingDate = $course['FECHA_INICIO'];
        $finalDate = $course['FECHA_FINALIZACION'];
        $enrollmentDate = $course['FECHA_LIMITE'];
        $academicCharge = $course['CREDITOS'];
        $language = $course['IDIOMA'];
        $location = $course['LOCACION'];
        $parentProgram = $course['PRO_PROGRAMA'];
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "INSERT INTO PRO_CURSO
            (NOMBRE, FECHA_INICIO, FECHA_FINALIZACION, FECHA_LIMITE, CREDITOS,
            IDIOMA, LOCACION, PRO_PROGRAMA)
            VALUES
            ('$name','$startingDate','$finalDate','$enrollmentDate','$academicCharge',
            '$language','$location','$parentProgram')"
        );
        $connect->commit();
        return true;
    }
    
    /**
     * updateCourse
     *
     * Saves the data in the database in case the data needs to be updated.
     * @author Jason Zamora Trejos
     * @param array $config The configuration for the Table.
     * @return true
     */
    public function updateCourse(array $course)
    {
        $id = $course['PRO_CURSO'];
        $name = $course['NOMBRE'];
        $startingDate = $course['FECHA_INICIO'];
        $finalDate = $course['FECHA_FINALIZACION'];
        $enrollmentDate = $course['FECHA_LIMITE'];
        $academicCharge = $course['CREDITOS'];
        $language = $course['IDIOMA'];
        $location = $course['LOCACION'];
        $parentProgram = $course['PRO_PROGRAMA'];
        
        $result = TableRegistry::get('proCurso')->find('all');
                $result->update()
                    ->set(['NOMBRE' => $name, 
                           'FECHA_INICIO' => $startingDate, 
                           'FECHA_FINALIZACION' => $finalDate, 
                           'FECHA_LIMITE' => $enrollmentDate,
                           'CREDITOS' => $academicCharge,
                           'IDIOMA' => $language,
                           'LOCACION' => $location,
                           'PRO_PROGRAMA' => $parentProgram
                           ])
                    ->where(['PRO_CURSO' => $id])
                    ->execute();
        return true;
    }
    
    /**
     * @author Jason Zamora Trejos
     * Logically delete a course
     * @param $id = the course ID
     * @return int $result is 1 if ACTIVE is 1, 0 if ACTIVE is 0
     */
    public function logicalDelete($id=null, $active=null)
    {
        if($active == 1)
        {
           $result = TableRegistry::get('proCurso')->find('all');
                $result->update()
                    ->set(['activo' => 0])
                    ->where(['PRO_CURSO' => $id])
                    ->execute();
            return 0;
        }
        else
        {
            $result = TableRegistry::get('proCurso')->find('all');
                $result->update()
                    ->set(['activo' => 1])
                    ->where(['PRO_CURSO' => $id])
                    ->execute();
            return 1;
        }
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
            ->maxLength('SIGLA', 8);

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
}
