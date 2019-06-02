<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\ProProgramaController;
use Cake\Event\Event;
use Cake\Validation\Validator;
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
        $this->set(compact('proCurso'));
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
        $proCurso = $this->ProCurso->newEntity();
        if ($this->request->is('post')) {
            $proCurso = $this->ProCurso->patchEntity($proCurso, $this->request->getData());
            $form_data = $this->request->getData();
            
            /*This section is in charge of converting the user input to store it correctly in the data base*/
            $proCurso['FECHA_LIMITE'] = date("d/m/y", strtotime($form_data['FECHA_LIMITE']));
            $proCurso['FECHA_FINALIZACION'] = date("d/m/y", strtotime($form_data['FECHA_FINALIZACION']));
            $proCurso['FECHA_INICIO'] = date("d/m/y", strtotime($form_data['FECHA_INICIO']));
            
            if($proCurso['LOCACION']==0)
            {
               $proCurso['LOCACION'] = 'Costa Rica';
            }
            else
            {
               $proCurso['LOCACION'] = __('South Africa');
            }

            /*This section is in charge of saving the user input if it is correct to do so*/
            $lc_code = $this->ProCurso->isUnique($form_data['SIGLA']); //If the course ID existed alredy don't save it

            // Es solo para probar, recordar borrar.
            $this->loadModel('PRO_PROGRAMA');
            $foldername = '/'.date('Y', strtotime($date)).'-'.date('m', strtotime($date)).'-'.str_replace(' ', '_', $proCurso['NOMBRE']);
            $this->FileSystem->addFolder('FileSystem/'.'REU'.$foldername);
            die();

            if($lc_code == "1")
            {
               $this->Flash->error(__('The course alredy exits in the system.'));
            }
            else
            {
               if($this->ProCurso->save($proCurso)) {
                    $this->loadModel('PRO_PROGRAMA'); // Load the program model
                    
                    // Make the path to create a folder for the new course.
                    $foldername = '/'.date('Y', strtotime($date)).'-'.date('m', strtotime($date)).'-'.str_replace(' ', '_', $proCurso['NOMBRE']);
                    
                    // Create the new folder in the given path.
                    $this->FileSystem->addFolder('FileSystem/'.$this->PRO_PROGRAMA->getProgramName($proCurso['PRO_PROGRAMA']).$foldername);
                    
                    $this->Flash->success(__('The course has been saved.'));

                    return $this->redirect(['action' => 'index']);
               }
               $this->Flash->error(__('The course could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('proCurso'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pro Curso id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $proCurso = $this->ProCurso->get($id, ['contain' => []]);
        $lc_oldID = $proCurso['SIGLA'];
        $form_data = $this->request->getData();
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
            $lc_code = $this->ProCurso->isUnique($proCurso["SIGLA"]);
            if($lc_code == "1" && $proCurso['SIGLA'] != $lc_oldID) //If the course ID existed alredy don't save it
            {
               $this->Flash->error(__('The course alredy exits in the system.'));
            }
            else 
            {
               if ($this->ProCurso->save($proCurso)) 
               {
                  $this->Flash->success(__('The course has been saved.'));
   
                  return $this->redirect(['action' => 'index']);
               }
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $this->set(compact('proCurso'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pro Curso id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $proCurso = $this->ProCurso->get($id);
        if ($this->ProCurso->logicalDelete($proCurso['PRO_CURSO'], $proCurso['ACTIVO']) == 0) {
            $this->Flash->success(__('The course has been disabled.'));
        } else {
            $this->Flash->success(__('The course has been activated'));
        }

        return $this->redirect(['action' => 'index']);
    }
}