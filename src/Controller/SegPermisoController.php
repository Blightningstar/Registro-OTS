<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SegPermiso Controller
 *
 *
 * @method \App\Model\Entity\SegPermiso[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SegPermisoController extends AppController
{
    /**
     * Will allow me load the view with all the relations of rols and permission alredy existint
     * and after submit the request will call the corresponding action depending of the number 
     * given by the view (0 remove relation and 1 create) with the rol and the permission id.
     * 
     * @author Nathan González
     */
    public function MatrizPermisos()//SEG_POSEE_MatrizPermisos()
    {
        // Grant access to the SEG_POSEE table.
        $this->loadModel('seg_posee');

        // Get all the permission and all the relation with rols. 
        $vgo_DsPermisos = $this->SegPermiso->find('all');  
        $vgo_DsPermisosDeRol = $this->SegPermiso->SEG_POSEE_TraerPermisosPoseidos();  
        
        // Send the results of the two querys to the view.
        $this->set(compact('vgo_DsPermisos', $vgo_DsPermisos));
        $this->set(compact('vgo_DsPermisosDeRol', $vgo_DsPermisosDeRol));

        // If the request was submited.
        if ($this->request->is(['patch', 'post', 'put', 'ajax'])) {
            
            // Take the submited information.
            $data = $this->request->getData();

            if($data['tipo'] == 1){ // Will create a relation between the given permission and the given rol.
                $this->SegPermiso->SEG_POSEE_AgregarRegistro($data['segpermiso'], $data['segrol']);
                $this->Flash->success(__('The permission was granted corrently.'));
            }
            else{ // Will remove a relation between the given permission and the given rol.
                $this->SegPermiso->SEG_POSEE_EliminarRegistro($data['segpermiso'], $data['segrol']);
                $this->Flash->success(__('The permission was remove corrently.'));
            }

            // Will refrash the view
            $this->redirect(['action' => 'MatrizPermisos']);
        }
    }
}
