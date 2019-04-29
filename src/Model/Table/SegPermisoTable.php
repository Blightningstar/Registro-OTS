<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * SegPermiso Model
 *
 * @method \App\Model\Entity\SegPermiso get($primaryKey, $options = [])
 * @method \App\Model\Entity\SegPermiso newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SegPermiso[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SegPermiso|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SegPermiso saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SegPermiso patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SegPermiso[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SegPermiso findOrCreate($search, callable $callback = null, $options = [])
 */
class SegPermisoTable extends Table
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

        $this->setTable('seg_permiso');
        $this->setDisplayField('SEG_PERMISO');
        $this->setPrimaryKey('SEG_PERMISO');

        $this->belongsTo('seg_posee', [
            'foreignKey' => ['SEG_PERMISO'],
            'bindingKey' => ['SEG_ROL'],
            'joinType' => 'INNER'
		]);
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
            ->integer('SEG_PERMISO')
            ->allowEmptyString('SEG_PERMISO', 'create');

        $validator
            ->scalar('DESCRIPCION_ESP')
            ->maxLength('DESCRIPCION_ESP', 256)
            ->allowEmptyString('DESCRIPCION_ESP');

        $validator
            ->scalar('DESCRIPCION_ING')
            ->maxLength('DESCRIPCION_ING', 256)
            ->requirePresence('DESCRIPCION_ING', 'create')
            ->allowEmptyString('DESCRIPCION_ING', false);

        return $validator;
    }

    /**
     * SEG_POSEE_TraerPermisosPoseidos
     * @author Nathan González
     * 
     * Query to get all the relations in the SEG_POSEE table.
     * 
     * @return set all the relation between rols and permissions.
     */
    public function SEG_POSEE_TraerPermisosPoseidos()
    {
        $connet = ConnectionManager::get('default');
        $query = $connet->execute(
        "SELECT PO.SEG_PERMISO, PO.SEG_ROL
        FROM SEG_PERMISO P, SEG_POSEE PO
        WHERE P.SEG_PERMISO = PO.SEG_PERMISO 
        ORDER BY PO.SEG_PERMISO, PO.SEG_ROL ASC;"
        )->fetchAll();
        return $query;
    }

    /**
     * SEG_POSEE_AgregarRegistro
     * @author Nathan González
     * 
     * Storage procedure to grant a given perssion ($SEG_PERMISO) to a given rol ($SEG_ROL).
     * 
     * @param int $SEG_PERMISO the id of the given permission.
     * @param int $SEG_ROL the id of the given rol.
     */
    public function SEG_POSEE_AgregarRegistro($SEG_PERMISO, $SEG_ROL){
        $connet = ConnectionManager::get('default');
        $connet->execute(
            "CALL SEG_POSEE_AGREGAR('$SEG_PERMISO', '$SEG_ROL')"
        );
    }

    /**
     * SEG_POSEE_EliminarRegistro
     * @author Nathan González
     * 
     * Storage procedure to remove a given perssion ($SEG_PERMISO) to a given rol ($SEG_ROL).
     * 
     * @param int $SEG_PERMISO the id of the given permission.
     * @param int $SEG_ROL the id of the given rol.
     */
    public function SEG_POSEE_EliminarRegistro($SEG_PERMISO, $SEG_ROL){
        $connet = ConnectionManager::get('default');
        $connet->execute(
            "CALL SEG_POSEE_ELIMINAR('$SEG_PERMISO', '$SEG_ROL')"
        );
    }
}
