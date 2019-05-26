<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\ProProgramaController;
use Cake\Event\Event;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
/**
 * ProCurso Controller
 * @author Jason Zamora Trejos
 * @property \App\Model\Table\ProCursoTable $ProCurso
 *
 * @method \App\Model\Entity\ProCurso[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProCursoController extends AppController
{
    /**
     * beforeFilter
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * This method runs before any other method of this controller, it sets values to variables
     * that can be used in any view of this módule, in this case sets $active_menu = "MenubarCourses"
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('active_menu', 'MenubarCourses');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $proCurso = $this->paginate($this->ProCurso);
        $this->Programa = $this->loadModel('pro_Programa');
        $this->Usuario= $this->loadModel('seg_Usuario');
        $proPrograma = $this->paginate($this->Programa);
        $segUsuario = $this->paginate($this->Usuario);
        debug($segUsuario);
        $this->set(compact('proCurso','proPrograma'));
    }

    /**
     * View method
     *
     * @param string|null $id Pro Curso id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $proCurso = $this->ProCurso->get($id, [
            'contain' => []
        ]);

        $this->set('proCurso', $proCurso);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        /*Loads the ID's of program's for the add view*/
        $this->Programa = $this->loadModel('pro_Programa');
        $proPrograma = $this->paginate($this->Programa);
        $lo_vector_Programa = [];
        foreach ($proPrograma as $proPrograma): 
           array_push($lo_vector_Programa, $proPrograma['PRO_PROGRAMA']);
        endforeach;
        
        $proCurso = $this->ProCurso->newEntity();
        if ($this->request->is('post')) {
            $proCurso = $this->ProCurso->patchEntity($proCurso, $this->request->getData());
            $form_data = $this->request->getData();
            $proCurso['PRO_PROGRAMA'] = $lo_vector_Programa[$proCurso['PRO_PROGRAMA']];
            /*This section is in charge of converting the user input to store it correctly in the data base*/
            $proCurso['FECHA_LIMITE'] = date("d-M-Y", strtotime($form_data['FECHA_LIMITE']));
            $proCurso['FECHA_FINALIZACION'] = date("d-M-Y", strtotime($form_data['FECHA_FINALIZACION']));
            $proCurso['FECHA_INICIO'] = date("d-M-Y", strtotime($form_data['FECHA_INICIO']));
            if($proCurso['LOCACION']==0)
            {
               $proCurso['LOCACION'] = 'Costa Rica';
            }
            else
            {
               $proCurso['LOCACION'] = __('South Africa');
            }

            /*This section is in charge of saving the user input if it is correct to do so*/
            $lc_code = $this->isUnique($form_data['SIGLA']); //If the course ID existed alredy don't save it

            if($lc_code == "1")
            {
               $this->Flash->error(__('The course alredy exits in the system.'));
            }
            else
            {
               if ($this->ProCurso->save($proCurso, $proPrograma)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
               }
               $this->Flash->error(__('The course could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('proCurso','lo_vector_Programa'));
    }

    /**
     * Edit method
     *
     * @author Jason Zamora Trejos
     * @param string|null $id Pro Curso id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $proCurso = $this->ProCurso->get($id, ['contain' => []]);
        $lc_oldID = $proCurso['SIGLA'];
        $form_data = $this->request->getData();
        
        /*Loads the ID's of program's for the add view*/
        $this->Programa = $this->loadModel('pro_Programa');
        $proPrograma = $this->paginate($this->Programa);
        $lo_vector_Programa = [];
        foreach ($proPrograma as $proPrograma): 
           array_push($lo_vector_Programa, $proPrograma['PRO_PROGRAMA']);
        endforeach;
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proCurso = $this->ProCurso->patchEntity($proCurso, $this->request->getData());
            $form_data = $this->request->getData();
            
            /*This section is in charge of converting the user input to store it correctly in the data base*/
            $proCurso['FECHA_LIMITE'] = date("d-M-Y", strtotime($form_data['FECHA_LIMITE']));
            $proCurso['FECHA_FINALIZACION'] = date("d-M-Y", strtotime($form_data['FECHA_FINALIZACION']));
            $proCurso['FECHA_INICIO'] = date("d-M-Y", strtotime($form_data['FECHA_INICIO']));
            if($proCurso['LOCACION']==0)
            {
               $proCurso['LOCACION'] = 'Costa Rica';
            }
            else
            {
               $proCurso['LOCACION'] = __('South Africa');
            }

            /*This section is in charge of saving the user input if it is correct to do so*/
            $lc_code = $this->isUnique($proCurso["SIGLA"]);
            if($lc_code == "1" && $proCurso['SIGLA'] != $lc_oldID) //If the course ID existed alredy don't save it
            {
               $this->Flash->error(__('The course alredy exits in the system.'));
            }
            else 
            {
               if ($this->ProCurso->save($proCurso, $proPrograma)) 
               {
                  $this->Flash->success(__('The course has been saved.'));
   
                  return $this->redirect(['action' => 'index']);
               }
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $this->set(compact('proCurso','lo_vector_Programa'));
    }

    /**
     * Delete method
     *
     * @author Jason Zamora Trejos
     * @param string|null $id Pro Curso id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $proCurso = $this->ProCurso->get($id);
        if ($this->logicalDelete($proCurso['PRO_CURSO'], $proCurso['ACTIVO']) == 0) {
            $this->Flash->success(__('The course has been disabled.'));
        } else {
            $this->Flash->success(__('The course has been activated'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
     /**
     * @author Jason Zamora Trejos
     * Logically delete a course
     * @param $id = the course ID
     * @return int $result is 1 if ACTIVE is 1, 0 if ACTIVE is 0
     */
    public function logicalDelete($id=null, $active=null)
    {
        debug($proCurso['ACTIVO']);
        $con = ConnectionManager::get('default');
        if($active == 1)
        {
            $result = TableRegistry::get('proCurso')->find('all');
                $result->update()
                    ->set(['activo' => 0])
                    ->where(['PRO_CURSO' => $id])
                    ->execute();
//            $result = $con->execute("update pro_curso set activo = '0' where PRO_CURSO = '$id'");
            debug($proCurso['ACTIVO']);
            return 0;
        }
        else
        {
            $result = TableRegistry::get('proCurso')->find('all');
                $result->update()
                    ->set(['activo' => 1])
                    ->where(['PRO_CURSO' => $id])
                    ->execute();
            debug($proCurso['ACTIVO']);
//            $result = $con->execute("update pro_curso set activo = '1' where PRO_CURSO = '$id'");
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
//        $lc_code = "0";
//        $lo_connet = ConnectionManager::get('default');
//        $lc_result = $lo_connet->execute("SELECT SIGLA FROM pro_curso WHERE SIGLA = '$lc_Id'");
        $assets = TableRegistry::get('proCurso')->find('all');
        $lc_result = $assets->find()
                        ->select(['proCurso.SIGLA'])
                        ->where(['proCurso.SIGLA' => $lc_Id])
                        ->toList();
        debug($lc_result);
//        $lc_result = $lc_result->fetchAll('assoc');
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