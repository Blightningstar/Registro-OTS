<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * SolFormulario Controller
 *
 *
 * @method \App\Model\Entity\SolFormulario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolFormularioController extends AppController
{
	/**
     * beforeFilter
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * This method runs before any other method of this controller, it sets values to variables
     * that can be used in any view of this módule, in this case sets $active_menu = "MenubarUsers"
     */
    public function beforeFilter(Event $event)
    {        
        parent::beforeFilter($event);
        $this->set('active_menu', 'MenubarForm');
    }
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $solFormulario = $this->paginate($this->SolFormulario);
		
        $this->set(compact('solFormulario'));

        // $test = "hola";
        // $this->set(compact('test'));

        $query = $sol_pregunta->find('all');
        // Iteration will execute the query.
        // foreach ($query as $row) {
        //     $id = $row['sol_pregunta'];
        //     $descrEsp = $row['DESCRIPCION_ESP'];
        //     $descrIng = $row['DESCRIPCION_ING'];
        //     $tipo = $row['TIPO'];
        //     $req = $row['REQUERIDO'];
        //     $active = $row['ACTIVO'];
        // }

        // Calling all() will execute the query
        // and return the result set.
        $results = $query->all();

        // Once we have a result set we can get all the rows
        $data = $results->toList();

        // Converting the query to a key-value array will also execute it.
        $data = $query->toArray();
        $this->set(compact("data"));
    }

    /**
     * View method
     *
     * @param string|null $id Sol Formulario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $solFormulario = $this->SolFormulario->get($id, [
            'contain' => []
        ]);

        $this->set('solFormulario', $solFormulario);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $solFormulario = $this->SolFormulario->newEntity();
        if ($this->request->is('post')) {
            $solFormulario = $this->SolFormulario->patchEntity($solFormulario, $this->request->getData());
            if ($this->SolFormulario->save($solFormulario)) {
                $this->Flash->success(__('The sol formulario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sol formulario could not be saved. Please, try again.'));
        }
        $this->set(compact('solFormulario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sol Formulario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $solFormulario = $this->SolFormulario->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solFormulario = $this->SolFormulario->patchEntity($solFormulario, $this->request->getData());
            if ($this->SolFormulario->save($solFormulario)) {
                $this->Flash->success(__('The sol formulario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sol formulario could not be saved. Please, try again.'));
        }
        $this->set(compact('solFormulario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sol Formulario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $solFormulario = $this->SolFormulario->get($id);
        if ($this->SolFormulario->delete($solFormulario)) {
            $this->Flash->success(__('The sol formulario has been deleted.'));
        } else {
            $this->Flash->error(__('The sol formulario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Get all the questions for the add question function
     * @author Anyelo Mijael Lobo Cheloukhin
     *
     * @param 
     * @return 
     */
    public function get_questions(){
    //     $data = array();
    //     $query = $this->db->get(SOL_PREGUNTA);
    //     $res = $query->result();
        $query = $sol_pregunta->find('all');
        // Iteration will execute the query.
        foreach ($query as $row) {
            $id = $row['sol_pregunta'];
            $descrEsp = $row['DESCRIPCION_ESP'];
            $descrIng = $row['DESCRIPCION_ING'];
            $tipo = $row['TIPO'];
            $req = $row['REQUERIDO'];
            $active = $row['ACTIVO'];
        }

        // Calling all() will execute the query
        // and return the result set.
        $results = $query->all();

        // Once we have a result set we can get all the rows
        $data = $results->toList();

        // Converting the query to a key-value array will also execute it.
        $data = $query->toArray();
        $this->set("data", $data);

    }
}
