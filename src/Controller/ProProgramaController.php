<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProPrograma Controller
 *
 * @author Anyelo Mijael Lobo Cheloukhin
 * @property \App\Model\Table\ProProgramaTable $ProPrograma
 *
 * @method \App\Model\Entity\ProPrograma[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProProgramaController extends AppController
{

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
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $proPrograma = $this->ProPrograma->newEntity();

        
        
        if ($this->request->is('post')) {
            $proPrograma = $this->ProPrograma->patchEntity($proPrograma, $this->request->getData());

            $proPrograma["PRO_PROGRAMA"] = $_REQUEST['NOMBRE']; //Primary Key is the name of the program
            $proPrograma["ACTIVO"] = 'S';
            $lc_code = $this->checkUniqueData($proPrograma["NOMBRE"] );
            if($lc_code == "1"){
                 $this->Flash->error(__("Error: This program is already in the system."));
            }
            else{
                if ($this->ProPrograma->save($proPrograma)) {
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
     *
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
                $this->Flash->success(__('The pro programa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pro programa could not be saved. Please, try again.'));
        }
        $this->set(compact('proPrograma'));
    }


     /**
     * Removes logically a program by his id
     * From S to N
     *
     * @return Succesful logical delete or not.
     */
    public function deleteProgram($id)
    {
        return $this->ProPrograma->deleteProgram($id);
    }

    /**
     * Delete method
     * 
     * @param string|null $id Pro Programa id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $proPrograma = $this->ProPrograma->get($id);
        if ($this->deleteProgram($id)) {
            $this->Flash->success(__('The program was erased correctly'));
        } else {
            $this->Flash->error(__("Error: the program can't be removed."));
        }

        return $this->redirect(['action' => 'index']);
    }
}
