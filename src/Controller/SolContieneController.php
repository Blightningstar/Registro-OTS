<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SolContiene Controller
 *
 * @property \App\Model\Table\SolContieneTable $SolContiene
 *
 * @method \App\Model\Entity\SolContiene[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolContieneController extends AppController
{
    // public $components = array('Session'); // To pass data to SolFormulario Controller

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $solContiene = $this->paginate($this->SolContiene);

        $this->set(compact('solContiene'));
    }

    /**
     * View method
     *
     * @param string|null $id Sol Contiene id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $solContiene = $this->SolContiene->get($id, [
            'contain' => []
        ]);

        $this->set('solContiene', $solContiene);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $solContiene = $this->SolContiene->newEntity();
        if ($this->request->is('post')) {
            $solContiene = $this->SolContiene->patchEntity($solContiene, $this->request->getData());
            if ($this->SolContiene->save($solContiene)) {
                $this->Flash->success(__('The sol contiene has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sol contiene could not be saved. Please, try again.'));
        }
        $this->set(compact('solContiene'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sol Contiene id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $solContiene = $this->SolContiene->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solContiene = $this->SolContiene->patchEntity($solContiene, $this->request->getData());
            if ($this->SolContiene->save($solContiene)) {
                $this->Flash->success(__('The sol contiene has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sol contiene could not be saved. Please, try again.'));
        }
        $this->set(compact('solContiene'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sol Contiene id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $solContiene = $this->SolContiene->get($id);
        if ($this->SolContiene->delete($solContiene)) {
            $this->Flash->success(__('The sol contiene has been deleted.'));
        } else {
            $this->Flash->error(__('The sol contiene could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
