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
 * @author Jason Zamora Trejos
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
        $this->belongsTo('pro_programa',[
             'foreignKey' => ['pro_curso_ibfk_2'],
             'bindingKey' => ['PRO_PROGRAMA'],
             'joinType' => 'INNER']);
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
            ->scalar('PRO_CURSO')
            ->maxLength('PRO_CURSO', 256)
            ->requirePresence('PRO_CURSO', 'create')
            ->allowEmptyString('PRO_CURSO', false);

        $validator
            ->scalar('NOMBRE')
            ->maxLength('NOMBRE', 256)
            ->requirePresence('NOMBRE', 'create')
            ->allowEmptyString('NOMBRE', false);

        $validator
            ->date('FECHA_INICIO')
            ->requirePresence('FECHA_INICIO', 'create')
            ->allowEmptyDate('FECHA_INICIO', false);

        $validator
            ->date('FECHA_FINALIZACION')
            ->requirePresence('FECHA_FINALIZACION', 'create')
            ->allowEmptyDate('FECHA_FINALIZACION', false);

        $validator
            ->date('FECHA_LIMITE')
            ->requirePresence('FECHA_LIMITE', 'create')
            ->allowEmptyDate('FECHA_LIMITE', false);

        $validator
            ->integer('CREDITOS')
            ->requirePresence('CREDITOS', 'create')
            ->allowEmptyString('CREDITOS', false);

        $validator
            ->scalar('IDIOMA')
            ->maxLength('IDIOMA', 256)
            ->requirePresence('IDIOMA', 'create')
            ->allowEmptyString('IDIOMA', false);

        $validator
            ->scalar('LOCACION')
            ->maxLength('LOCACION', 256)
            ->requirePresence('LOCACION', 'create')
            ->allowEmptyString('LOCACION', false);

        $validator
            ->scalar('ACTIVO')
            ->maxLength('ACTIVO', 1)
            ->allowEmptyString('ACTIVO');

        $validator
            ->scalar('PRO_PROGRAMA')
            ->maxLength('PRO_PROGRAMA', 256)
            ->allowEmptyString('PRO_PROGRAMA');

        $validator
            ->scalar('SEG_USUARIO')
            ->maxLength('SEG_USUARIO', 256)
            ->allowEmptyString('SEG_USUARIO');

        $validator
            ->scalar('SOL_FORMULARIO')
            ->maxLength('SOL_FORMULARIO', 256)
            ->allowEmptyString('SOL_FORMULARIO');

        return $validator;
    }
    
     /**
     *  @author Jason Zamora Trejos
     *  Checks the course Active state to show it or not
     * 
     *  @return 0 if program don't exist, 1 if exist
     */
    public function nonLogicalDelete()
    {
        $con = ConnectionManager::get('default');
        $result = $con->execute("SELECT NOMBRE FROM PRO_CURSO WHERE ACTIVO = '1'");
        $result = $result->fetchAll('assoc');
        return $result;
    }
}