<?php
namespace App\Controller;

use App\Controller\AppController;
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
     * @param program_id Show only courses belonging to the specified program.
     * @return \Cake\Http\Response|void
     */
    public function index($program_id = null)
    {
        // The user have the permission for this action?
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(2, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

        $proCurso = $this->paginate($this->ProCurso);
        $this->set(compact('proCurso', $proCurso, 'program_id', $program_id));
        if ($this->request->is('post')) {
            $solSolicitud = $this->request->getData();
        }
    }

    /**
     * View method
     * @author Jason Zamora Trejos
     * @param string|null $id Pro Curso id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // The user have the permission for this action?
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(22, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

        $proCurso = $this->ProCurso->get($id, [
            'contain' => []
        ]);
        
        /*This two queries bring the name of the user who created the course, and the form attack to it*/
        $segUsuario = TableRegistry::get('seg_Usuario');
        $queryUsuario = $segUsuario->find()
                                    ->select(['NOMBRE_USUARIO'])
                                    ->where(['SEG_USUARIO'=>$proCurso['SEG_USUARIO']])
                                    ->toList();
                                    
        $solFormulario = TableRegistry::get('sol_Formulario');
        $queryFormulario = $solFormulario ->find()
                                    ->select(['NOMBRE'])
                                    ->where(['SOL_FORMULARIO'=>$proCurso['SOL_FORMULARIO']])
                                    ->toList();
        /*This ables to hide the form if non is selected*/                           
        if(!reset($queryFormulario)) 
        {
            $desplegar = 0;
        }
        else
        {
            $desplegar = 1;
        }                                                   
        $this->set(compact('proCurso', 'queryUsuario', 'queryFormulario', 'desplegar'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // The user have the permission for this action?
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(25, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

        /*Loads the ID's of program's for the add view*/
        $this->Programa = $this->loadModel('pro_Programa');
        $proPrograma = $this->paginate($this->Programa);
        $lo_vector_Programa = [];
        foreach ($proPrograma as $proPrograma): 
           array_push($lo_vector_Programa, $proPrograma['PRO_PROGRAMA']);
        endforeach;
        
        /*Loads the ID's of program's for the add view*/
        $this->Formulario = $this->loadModel('sol_Formulario');
        $solFormulario = $this->paginate($this->Formulario);
        $lo_vector_Formulario = [];
        array_push($lo_vector_Formulario,__('None'));
        foreach ($solFormulario as $solFormulario): 
           array_push($lo_vector_Formulario, $solFormulario['NOMBRE']);
        endforeach;
        
        $proCurso = $this->ProCurso->newEntity();
        if ($this->request->is('post')) {
            $proCurso = $this->ProCurso->patchEntity($proCurso, $this->request->getData());
            $form_data = $this->request->getData();
            $proCurso['PRO_PROGRAMA'] = $lo_vector_Programa[$proCurso['PRO_PROGRAMA']];
            /*This section is in charge of converting the user input to store it correctly in the data base*/
            $proCurso['FECHA_LIMITE'] = date("m/d/Y", strtotime($form_data['FECHA_LIMITE']));
            $proCurso['FECHA_FINALIZACION'] = date("m/d/Y", strtotime($form_data['FECHA_FINALIZACION']));
            $proCurso['FECHA_INICIO'] = date("m/d/Y", strtotime($form_data['FECHA_INICIO'])); 
            $proCurso['SEG_USUARIO'] = $this->viewVars['actualUser']['SEG_USUARIO'];
            $proCurso['ACTIVO'] = 1;
            if($proCurso['LOCACION']==0)
            {
               $proCurso['LOCACION'] = 'Costa Rica';
            }
            else
            {
               $proCurso['LOCACION'] = __('South Africa');
            }
            
            if($proCurso['SOL_FORMULARIO'] == 0)
            {
               $proCurso['SOL_FORMULARIO'] = 'Null';
            }
            else
            {
               $proCurso['SOL_FORMULARIO'] = $this->Formulario->getFormID($lo_vector_Formulario[$proCurso['SOL_FORMULARIO']]);
            }
			
			if(strtotime($proCurso['FECHA_INICIO']) < strtotime($proCurso['FECHA_LIMITE']))
				$this->Flash->error(__('Error: start date is sooner than last enrollment date'));
			else
				if(strtotime($proCurso['FECHA_FINALIZACION']) < strtotime($proCurso['FECHA_INICIO']))
					$this->Flash->error(__('Error: End date is sooner than final date'));
				else
					/*This section is in charge of saving the user input if it is correct to do so*/
					if ($this->ProCurso->insertCourse($proCurso)) {
						$this->loadModel('PRO_PROGRAMA'); // Load the program model
							
						// Make the path to create a folder for the new course.
						$foldername = '/'.date('Y', strtotime($proCurso['FECHA_INICIO'])).'-'.date('m', strtotime($proCurso['FECHA_INICIO'])).'-'.str_replace(' ', '_', $proCurso['NOMBRE']);

						// Create the new folder in the given path.
						$this->FileSystem->addFolder('FileSystem/'.$this->PRO_PROGRAMA->getProgramName($proCurso['PRO_PROGRAMA']).$foldername);
						
						$this->Flash->success(__('The course has been saved.'));
						return $this->redirect(['action' => 'index']);
					}
        }
        $this->set(compact('proCurso','lo_vector_Programa', 'lo_vector_Formulario'));
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
        // The user have the permission for this action?
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(23, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

        $proCurso = $this->ProCurso->get($id, ['contain' => []]);
        $form_data = $this->request->getData();
        
        /*Loads the ID's of program's for the add view*/
        $this->Programa = $this->loadModel('pro_Programa');
        $proPrograma = $this->paginate($this->Programa);
        $lo_vector_Programa = [];
        foreach ($proPrograma as $proPrograma): 
           array_push($lo_vector_Programa, $proPrograma['PRO_PROGRAMA']);
        endforeach;
        
        /*Loads the ID's of program's for the add view*/
        $this->Formulario = $this->loadModel('sol_Formulario');
        $solFormulario = $this->paginate($this->Formulario);
        $lo_vector_Formulario = [];
        array_push($lo_vector_Formulario,__('None'));
        foreach ($solFormulario as $solFormulario): 
           array_push($lo_vector_Formulario, $solFormulario['NOMBRE']);
        endforeach;
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proCurso = $this->ProCurso->patchEntity($proCurso, $this->request->getData());
            $form_data = $this->request->getData();
            $proCurso['PRO_PROGRAMA'] = $lo_vector_Programa[$proCurso['PRO_PROGRAMA']];
            
            /*This section is in charge of converting the user input to store it correctly in the data base*/
            $proCurso['FECHA_LIMITE'] = date("m/d/Y", strtotime($form_data['FECHA_LIMITE']));
            $proCurso['FECHA_FINALIZACION'] = date("m/d/Y", strtotime($form_data['FECHA_FINALIZACION']));
            $proCurso['FECHA_INICIO'] = date("m/d/Y", strtotime($form_data['FECHA_INICIO']));
            if($proCurso['LOCACION']==0)
            {
               $proCurso['LOCACION'] = 'Costa Rica';
            }
            else
            {
               $proCurso['LOCACION'] = __('South Africa');
            }
            
            if($proCurso['SOL_FORMULARIO'] == 0)
            {
               $proCurso['SOL_FORMULARIO'] = 'Null';
            }
            else
            {
               $proCurso['SOL_FORMULARIO'] = $this->Formulario->getFormID($lo_vector_Formulario[$proCurso['SOL_FORMULARIO']]);
            }

            /*This section is in charge of saving the user input if it is correct to do so*/
            if ($this->ProCurso->updateCourse($proCurso)) 
            {
               $this->Flash->success(__('The course has been saved.'));
               return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $this->set(compact('proCurso','lo_vector_Programa', 'lo_vector_Formulario'));
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
        // The user have the permission for this action?
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(24, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

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