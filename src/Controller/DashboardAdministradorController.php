<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * SolPregunta Controller
 *
 * @property \App\Model\Table\ProCursoTable $proCurso
 *
 * @method \App\Model\Entity\ProCurso[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardAdministradorController extends AppController
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
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $proCurso = $this->paginate($this->ProCurso);
        debug($proCurso);
        die();
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