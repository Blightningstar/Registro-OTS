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
            if ($this->SegUsuario->save($segUsuario)) {
                $this->Flash->success(__('The seg usuario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The seg usuario could not be saved. Please, try again.'));
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
            if ($this->SegUsuario->save($segUsuario)) {
                $this->Flash->success(__('The seg usuario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The seg usuario could not be saved. Please, try again.'));
        }
        $this->set(compact('segUsuario'));
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
        if ($this->SegUsuario->delete($segUsuario)) {
            $this->Flash->success(__('The seg usuario has been deleted.'));
        } else {
            $this->Flash->error(__('The seg usuario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * getHash
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Calls its model function to get the hashed password from the user known by $username.
     * @param string $username, it's the user identificator.
     * @return string the hashed password of the user.
     */
    public function getHash($username) {
        $userTable=$this->loadmodel('SegUsuario');
        return $userTable->getHash($username);
    }

    /**
     * setHash
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to set the hashed password $hash to the user known by $userdata.
     * @param string $userdata, it's the user identificator.
     * @param string $hash, it's the new hashed password of the user.
     */
    public function setHash($userdata,$hash) {
        $userTable=$this->loadmodel('SegUsuario');
        $userTable->setHash($userdata,$hash);
    }

    /**
     * getCode
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to get the restauration code from the user known by his $email.
     * @param string $email, it's the user identificator.
     * @return string the restauration code of the user.
     */
    public function getCode($email) {
        $userTable=$this->loadmodel('SegUsuario');
        return $userTable->getCode($email);
    }

    /**
     * setCode
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to set the restauration code to the user known by his $email.
     * @param string $email, it's the user identificator.
     * @param string $code, it's the new restauration code of the user.
     */
    public function setCode($email,$code) {
        $userTable=$this->loadmodel('SegUsuario');
        $userTable->setCode($email,$code);
    }

    /**
     * getEmailByUserData
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to get all the email of the user known by $userdata.
     * @param string $userdata, it's the user email or username.
     * @return string the user email.
     */
    public function getEmailByUserData($userdata){
        $userTable=$this->loadmodel('SegUsuario');
        return $userTable->getEmailByUserData($userdata);
    }


}
