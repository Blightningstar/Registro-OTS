<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SegUsuario Controller
 *
 * @property \App\Model\Table\SegUsuarioTable $SegUsuario
 *
 * @method \App\Model\Entity\SegUsuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SegUsuarioController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $segUsuario = $this->paginate($this->SegUsuario);

        $this->set(compact('segUsuario'));
    }

    /**
     * View method
     *
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);

        $this->set('segUsuario', $segUsuario);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $segUsuario = $this->SegUsuario->newEntity();
        if ($this->request->is('post')) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());

            
        
            $segUsuario["SEG_ROL"] += 1;

            if ($this->SegUsuario->save($segUsuario)) {
                $this->Flash->success(__('El usuario ha sido agregado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Error: No se puedo agregar al usuario'));
        }
        $this->set(compact('segUsuario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());
            $segUsuario["SEG_ROL"] += 1;
            if ($this->SegUsuario->save($segUsuario)) {
                $this->Flash->success(__('El usuario ha sido modificado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Error: No se puedo agregar al usuario'));
        }
        $this->set(compact('segUsuario'));
    }

    /**
     * Realiza un borrado lógico de un usuario según su id
     * 
     * @author Esteban Rojas
     * @return resultado indicando si el borrado fue exitoso o no.
     */
    public function deleteUser($id)
    {
        return $this->SegUsuario->deleteUser($id);
    }

    /**
     * Delete method
     *
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $segUsuario = $this->SegUsuario->get($id);
        if ($this->deleteUser($id)) {
            $this->Flash->success(__('El usuario ha sido eliminado.'));
        } else {
            $this->Flash->error(__('Error: el usuario no ha sido eliminado.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
