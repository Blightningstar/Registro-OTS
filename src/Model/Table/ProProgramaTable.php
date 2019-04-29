<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * ProPrograma Model
 *
 * @author Anyelo Mijael Lobo Cheloukhin
 * @method \App\Model\Entity\ProPrograma get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProPrograma newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProPrograma[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProPrograma|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProPrograma saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProPrograma patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProPrograma[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProPrograma findOrCreate($search, callable $callback = null, $options = [])
 */
class ProProgramaTable extends Table
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

        $this->setTable('pro_programa');
        $this->setDisplayField('PRO_PROGRAMA');
        $this->setPrimaryKey('PRO_PROGRAMA');
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
            ->scalar('PRO_PROGRAMA')
            ->maxLength('PRO_PROGRAMA', 256)
            ->allowEmptyString('PRO_PROGRAMA', 'create');

        $validator
            ->scalar('NOMBRE')
            ->maxLength('NOMBRE', 256)
            ->requirePresence('NOMBRE', 'create')
            ->allowEmptyString('NOMBRE', false);

        $validator
            ->scalar('ACTIVO')
            ->maxLength('ACTIVO', 1)
            ->allowEmptyString('ACTIVO');

        return $validator;
    }

    /**
     *  Checks if there is already a program with that name
     *  @author Anyelo Lobo
     *  @return 0 if program don't exist, 1 if exist
     */
    public function checkUniqueData($lc_name)
    {
        $lc_code = "0";
        $connet = ConnectionManager::get('default');
        $result = $connet->execute("SELECT NOMBRE FROM PRO_PROGRAMA WHERE NOMBRE = '$lc_name'");

        $result = $result->fetchAll('assoc');
        if(empty($result) == 0)
        {
   
            if($result[0]["NOMBRE"] == $lc_name)
                $lc_code = "1";
            
        }

        return $lc_code;
    }

       /**
     * Removes logically a program by his id
     * From 1 to 0
     * 
     */
    public function deleteProgram($id)
    {
        $code = 1;
        $connet = ConnectionManager::get('default');
        $result = $connet->execute("update pro_programa set activo = '0' where pro_programa = '$id'");
        return $code;
    }
}