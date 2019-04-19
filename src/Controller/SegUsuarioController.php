<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

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
     * Calls the model to changePasword
     * @author Esteban Rojas
     */
    public function userPasswordChange($id,$password)
    {
        $this->SegUsuario->userPasswordChange($id,$password);
    }





    /**
     * Generates a 20 length random passwoed
     * @author Esteban Rojas 
     * @return new password.
     */
    function generatePassword()
    {
        $lc_newPassword= "";

        for($lc_iteration = 0; $lc_iteration < 20; $lc_iteration = $lc_iteration + 1)
        {
            $ln_random = rand(65,90);
            
            if(rand(0,1) == 0)
                $ln_random = $ln_random + 32; // Sometimes set upper character

            $lc_character = chr($ln_random);
            $lc_newPassword = $lc_newPassword . $lc_character;
        }
        return $lc_newPassword;
    }


    /**
     * Index method
     * @author Esteban Rojas
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $segUsuario = $this->paginate($this->SegUsuario);

        $this->set(compact('segUsuario'));
    }

    /**
     * View method
     * @author Esteban Rojas
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
     * @author Esteban Rojas
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $segUsuario = $this->SegUsuario->newEntity();
        if ($this->request->is('post')) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());

            
       
            $segUsuario["SEG_ROL"] += 1;
            $lc_password = $this-> generatePassword();
            $segUsuario["CONTRASEÑA"] = hash('sha256',$lc_password);

 

            if ($this->SegUsuario->save($segUsuario)) {
                $this->Flash->success(__('User was added correctly. Password: ' . $lc_password));


                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("Error: User can't be added"));
        }
        $this->set(compact('segUsuario'));
    }

    /**
     * Edit method
     * @author Esteban Rojas
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
                $this->Flash->success(__('The user information was modified correctly.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("Error: the user information can't be modified"));
        }
        $this->set(compact('segUsuario'));
    }


    public function obtenerUsuarioActual()
    {
        return "US-2060";
    }

        /**
     * Edit method
     * @author Esteban Rojas
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function profileEdit($id = null)
    {
        //Se asegura de que el usuario solo pueda modificar su propio perfil
        $id = $this->obtenerUsuarioActual();
        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());
            $segUsuario["SEG_ROL"] += 1;
            if ($this->SegUsuario->save($segUsuario)) {
                $this->Flash->success(__('Your personal data was modified correctly'));

                return $this->redirect(['action' => 'profile-view']);
            }
            $this->Flash->error(__('Error: Your personal data '));
        }

        

        $this->set(compact('segUsuario'));
    }

     /**
     * In this view the user can only view his information
     * @author Esteban Rojas
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function profileView($id = null)
    {
        //Obtain logged user id
        $id = $this->obtenerUsuarioActual();

        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);

        $this->set('segUsuario', $segUsuario);
    }

    /**
     * Remove logically a user by his id.
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
     * @author Esteban Rojas
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $segUsuario = $this->SegUsuario->get($id);
        if ($this->deleteUser($id)) {
            $this->Flash->success(__('The user was erased correctly'));
        } else {
            $this->Flash->error(__("Error: the user can't be removed."));
        }

        return $this->redirect(['action' => 'index']);
    }
}
