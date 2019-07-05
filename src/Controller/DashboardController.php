<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * ProCurso Controller
 *
 * @property \App\Model\Table\ProCursoTable $proCurso
 *
 * @method \App\Model\Entity\ProCurso[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
{
    /**
     * beforeFilter
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * This method runs before any other method of this controller, it sets values to variables
     * that can be used in any view of this módule, in this case sets $active_menu = "MenubarDashboardAdministrator"
     */     
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('active_menu', 'MenubarDashboard');
    }

    /**
     * Index method
     * @author Jason Zamora Trejos
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $proCurso = TableRegistry::get('pro_Curso');
        $queryDashboard = $proCurso->find()
                         ->select([])
                         ->where(['pro_Curso.SEG_USUARIO' => $this->viewVars['actualUser']['SEG_USUARIO']])
                         ->toList();
        $this->set(compact('queryDashboard'));
    }

    /**
     * cursoViewDashboard method
     *
     * @author Jason Zamora Trejos
     * @param string|null $id Pro Curso id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function cursoViewDashboard($id = null)
    {
        // The user have the permission for this action?
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(14, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

        $this->Curso = $this->loadModel('pro_Curso'); //Bring the information of the table pro_Curso.
        $proCurso = $this->Curso->get($id, ['contain' => []]); //Use the id to show only the course selected we pass through an html link.
        $solicitud = $this->loadModel('sol_Solicitud'); //Bring the information of the table sol_Solicitud.
                           
        /*A table's JOIN to be able to access all the necessary data */
         $solSolicitud = TableRegistry::get('solSolicitud');
         $Query = $solSolicitud->find()
                         ->select(['segUsuario.SEG_USUARIO','solSolicitud.RESULTADO', 'segUsuario.NOMBRE','segUsuario.APELLIDO_1','segUsuario.APELLIDO_2'])
                         ->join([
                            'segUsuario' => [
                                    'table' => 'SEG_USUARIO',
                                    'type'  => 'LEFT',
                                    'conditions' => ['segUsuario.SEG_USUARIO = solSolicitud.SEG_USUARIO']
                                ]
                                ])
                                ->where(['solSolicitud.PRO_CURSO' => $id, 'solSolicitud.ACTIVO' => 1])
                                ->toList();
        
        $this->set(compact('proCurso', 'Query', 'solicitud'));
    }
    
    public function studentDashboard()
    {
        // The user have the permission for this action?
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(13, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

        $application_controller = new SolSolicitudController;
        $user_applications = $application_controller->getUserApplications($this->viewVars['actualUser']['SEG_USUARIO']);

        $this->set(compact('user_applications'));
    }
    
    /**
     * Review Application method
     *
     * @author Jason Zamora Trejos
     * @param string|null $idUsuario Seg User id, $idCurso Pro Curso id
     * @return redirect to the application view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function review($idUsuario = null, $idCurso = null)
    {
         // load the model you need depending on the controller you need to use
        $SolSolicitudController = new SolSolicitudController;
        return  $this->redirect(['controller' => 'SolSolicitud','action' => 'view',$idUsuario,$idCurso]);
    }
    
    /**
     * Export PDF method
     *
     * @author Jason Zamora Trejos
     * @param
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function exportPDF($idCurso = null, $idUsuario=null)
    {
        // The user have the permission for this action?
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(28, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

        $SolSolicitudController = new SolSolicitudController;
        $SolSolicitudController->getPDF($idUsuario, $idCurso);
    }
    
    /**
     * accept method
     *
     * @author Jason Zamora Trejos
     * @param string|null $idCurso Pro Curso id ,$idUsuario Seg Usuario id.
     * @return redirect to the curso_View_Dashboard view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function accept($idCurso = null, $idUsuario = null)
    {
        $cursoSolicitud = TableRegistry::get('solSolicitud')->find()->where(['PRO_CURSO' => $idCurso]);
        /*Updates the RESULTADO of the application if accepted*/
        $cursoSolicitud->update()
        ->set(['RESULTADO' => 'Aceptado'])
        ->where(['SEG_USUARIO' => $idUsuario])
        ->execute();
        return $this->redirect(['action' => 'cursoViewDashboard',$idCurso]);
    }
    
    
    /**
     * denied method
     *
     * @author Jason Zamora Trejos
     * @param string|null $idCurso Pro Curso id ,$idUsuario Seg Usuario id.
     * @return redirect to the curso_View_Dashboard view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function denied($idCurso = null, $idUsuario = null)
    {
        debug($idCurso);
        debug($idUsuario);
        $assets = TableRegistry::get('solSolicitud')->find()->where(['PRO_CURSO' => $idCurso]);
        /*Updates the RESULTADO of the application if accepted*/
        $assets->update()
        ->set(['RESULTADO' => 'Rechazado'])
        ->where(['SEG_USUARIO' => $idUsuario])
        ->execute();
        return $this->redirect(['action' => 'cursoViewDashboard',$idCurso]);
    }
}
   

 