<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProPrograma Controller
 *
 * @property \App\Model\Table\ProProgramaTable $ProPrograma
 *
 * @method \App\Model\Entity\ProPrograma[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProProgramaController extends AppController
{
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
            if ($this->ProPrograma->save($proPrograma)) {
                $this->Flash->success(__('The pro programa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pro programa could not be saved. Please, try again.'));
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
        if ($this->ProPrograma->delete($proPrograma)) {
            $this->Flash->success(__('The pro programa has been deleted.'));
        } else {
            $this->Flash->error(__('The pro programa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
