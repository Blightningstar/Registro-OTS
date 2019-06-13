<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * ProPrograma Controller
 *
 * @author Anyelo Lobo
 * @property \App\Model\Table\ProProgramaTable $ProPrograma
 *
 * @method \App\Model\Entity\ProPrograma[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProProgramaController extends AppController
{
    /**
     * beforeFilter
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * This method runs before any other method of this controller, it sets values to variables
     * that can be used in any view of this módule, in this case sets $active_menu = "MenubarPrograms"
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('active_menu', 'MenubarPrograms');
    }

    /**
     * Checks if there is already a program with that name
     * @author Anyelo Lobo
     * @return 0 if program don't exist, 1 if exist
     */
    function checkUniqueData($lc_name)
    {
        return $this->ProPrograma->checkUniqueData($lc_name);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $proPrograma = $this->paginate($this->ProPrograma);

        $this->set(compact('proPrograma'));
    }

    /**
     * View method
     *
     * @param string|null $id Pro Programa id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $proPrograma = $this->ProPrograma->get($id, [
            'contain' => []
        ]);

        $this->set('proPrograma', $proPrograma);
    }

    /**
     * Add method
     * @author Anyelo Lobo
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $proPrograma = $this->ProPrograma->newEntity();

        if ($this->request->is('post')) {
            $proPrograma = $this->ProPrograma->patchEntity($proPrograma, $this->request->getData());

            $proPrograma["PRO_PROGRAMA"] = substr($_REQUEST['NOMBRE'], 0, 3); //Primary Key is the name of the program
            $proPrograma["ACTIVO"] = '1';
            $lc_code = $this->checkUniqueData($proPrograma["NOMBRE"] );
            if($lc_code == "1"){
                 $this->Flash->error(__("Error: This program is already in the system."));
            }
            else{
                if ($this->ProPrograma->save($proPrograma)) {
                    // Create a folder for the new program.
                    $this->FileSystem->addFolder('FileSystem/'.$proPrograma['NOMBRE']); 
                    $this->Flash->success(__('The pro programa has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The program could not be saved. Please, try again.'));
        }
        $this->set(compact('proPrograma'));
    }

    /**
     * Edit method
     * @author Anyelo Lobo
     * @param string|null $id Pro Programa id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $proPrograma = $this->ProPrograma->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proPrograma = $this->ProPrograma->patchEntity($proPrograma, $this->request->getData());
            if ($this->ProPrograma->save($proPrograma)) {
                $this->Flash->success(__('The programa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The programa could not be saved. Please, try again.'));
        }
        $this->set(compact('proPrograma'));
        $ACTIVO = array('Inactive','Active');
        $this->set('ACTIVO',$ACTIVO);
    }


     /**
     * Change the active attribute of the program
     * @author Anyelo Lobo
     * @return Succesful active change or not.
     */
    public function deleteProgram($id)
    {
        return $this->ProPrograma->deleteProgram($id);
    }

    /**
     * Delete method that calls deleteProgram() method 
     * @author Anyelo Lobo
     * @param string|null $id Pro Programa id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $proPrograma = $this->ProPrograma->get($id);
        if ($this->deleteProgram($id)) {
            $this->Flash->success(__('The program active state has been changed'));
        } else {
            $this->Flash->error(__("Error: the program can't be removed."));
        }

        return $this->redirect(['action' => 'index']);
    }
}
