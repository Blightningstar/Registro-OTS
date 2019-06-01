<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

use Cake\ORM\TableRegistry;



/**
 * SolFormulario Controller
 *
 *
 * @method \App\Model\Entity\SolFormulario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolFormularioController extends AppController
{
    
    // public $components = array('Session'); // To pass data from SolContiene Controller

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
        $preguntas= $this->getPreguntasContiene($id);
        $this->set('preguntas', $preguntas);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   
        /* Select all questions for the select boxes in the view*/
        $preguntas = TableRegistry::get('SolPregunta');
        $pregunta = $preguntas->find('all');
        $this->set(compact('pregunta'));

        $solFormulario = $this->SolFormulario->newEntity();

        /* Bring SolContiene Model*/
        $contiene = TableRegistry::get('SolContiene');
        $this->loadModel('SolContiene');
        $solContiene = $this->SolContiene->newEntity();

        if ($this->request->is('post')) {
            $varQuest = $_POST['questions'];
            echo $varQuest;
            $this->Flash->error(__($varQuest));

            $solFormulario = $this->SolFormulario->patchEntity($solFormulario, $this->request->getData());
            $solFormulario['SOL_FORMULARIO'] = "TEST";

            $solContiene = $this->SolContiene->patchEntity($solContiene, $this->request->getData());
            $solContiene['SOL_PREGUNTA'] = $varQuest;
            $solContiene['SOL_FORMULARIO'] = $solFormulario['SOL_FORMULARIO'];
            // $solContiene['NUMERO_PREGUNTA'] = 1;

            if ($this->SolFormulario->save($solFormulario)) {
                $this->Flash->success(__('The sol formulario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sol formulario could not be saved. Please, try again.'));
        }
        $this->set(compact('solFormulario'));
        $this->set(compact('solContiene'));
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

    public function getPreguntasContiene($id)
    {
        $formTable = $this->loadModel('SolFormulario');
        return $formTable->getPreguntasContiene($id);
    }
}
