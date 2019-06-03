<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

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
her method of this controller, it sets values to variables     */
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
        $this->Curso = $this->loadModel('pro_Curso'); //Bring the information of the table pro_Curso.
        $proCurso= $this->paginate($this->Curso);
        $this->set(compact('proCurso'));
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
        $this->Curso = $this->loadModel('pro_Curso'); //Bring the information of the table pro_Curso.
        $proCurso = $this->Curso->get($id, ['contain' => []]); //Use the id to show only the course selected we pass through an html link.
        
                                    
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
        debug($Query);
        debug($Query[1]['segUsuario']['NOMBRE']);
//        $lo_vector_dashboard = [];
//        foreach ($Query as $Query): 
//           array_push($lo_vector_Programa, $proPrograma['PRO_PROGRAMA']);
//        endforeach;
        $this->set(compact('proCurso', 'Query'));
    }
    
    /**
     * accept method
     *
     * @author Jason Zamora Trejos
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function accept($idCurso = null, $idUsuario)
    {
        $assets = TableRegistry::get('solSolicitud')->find()->where(['PRO_CURSO' => $idCurso]);
        /*Updates the RESULTADO of the application if accepted*/
        $assets->update()
        ->set(['RESULTADO' => "Approved"])
        ->where(['SEG_USUARIO' => $idUsuario])
        ->execute();
    }
}
   

 