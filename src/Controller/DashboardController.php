<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

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
        $this->set('active_menu', 'MenubarDashboardAdministrator');
    }

    /**
     * Index method
     * @author = Jason Zamora Trejos
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //debug('Sirve');
        //die();
        $this->set(compact('proCurso'));
    }

    /**
     * Shows the student dashboard. Don't require any submit action
     * @author Esteban Rojas 
     */
    public function studentDashboard()
    {
        $formulary_controller = new SolFormularioController;
        $user_applications = $formulary_controller->getUserApplications($this->viewVars['actualUser']['SEG_USUARIO']);

        $this->set(compact('user_applications'));
    }

    /**
     * cursoViewDashboard method
     *
     * @author = Jason Zamora Trejos
     * @param string|null $id Pro Curso id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function cursoViewDashboard($id = null)
    {
        $this->set(compact('proCurso'));
    }

    /**
     * Add method
     * @author Jason Zamora Trejos
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
      $proCurso = $this->ProCurso->newEntity();
        if ($this->request->is('post')) {
            $proCurso = $this->ProCurso->patchEntity($proCurso, $this->request->getData());
            $form_data = $this->request->getData();

            if ($this->ProCurso->save($proCurso)) {
               $this->Flash->success(__('The information has been saved.'));
               return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The information could not be saved. Please, try again.'));
        }
        $this->set(compact('proCurso'));
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
        $form_data = $this->request->getData();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proCurso = $this->ProCurso->patchEntity($proCurso, $this->request->getData());
            $form_data = $this->request->getData();
            if ($this->ProCurso->save($proCurso)) 
            {
               $this->Flash->success(__('The information has been saved.'));
               return $this->redirect(['action' => 'index']);
            }   
            $this->Flash->error(__('The information could not be saved. Please, try again.'));
        }
        $this->set(compact('proCurso'));
    }

    /**
     * Delete method
     *
     * @author Jason Zamora Trejos
     * @param string|null $id Pro Curso id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id)
    {
        return $this->redirect(['action' => 'index']);
    }
}