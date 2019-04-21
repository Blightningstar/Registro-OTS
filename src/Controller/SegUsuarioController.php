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
     *  Checks if the username or email is already on database
     *  @author Esteban Rojas
     *  @return 1 si no hay nada repetido, 2 si el usuario esta repetido 3 si el correo esta repetido.
     *  Si el usuario y correo estan repetidos, solo indica que el usuario esta repetido
     */
    function checkUniqueData($lc_username, $lc_email)
    {
        return $this->SegUsuario->checkUniqueData($lc_username, $lc_email);
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
     * @author EstebanRojas
     * @return Username of authenticated user
     */
    function getActualUsername()
    {
        return "Superusuario";
    }

    /**
     * To know Authenticated user's role
     * @author Esteban Rojas
     * @return "1" => student, "2" => "Administrator", "3" => "Superuser"
     */
    function actualRole()
    {
        return $this->SegUsuario->getUserRoleByUsername($this->getActualUsername());
    }


    /**
     * Index method
     * @author Esteban Rojas
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $lc_role = $this->actualRole();
 
        //Redirect students 
        if($lc_role == "1")
        {
            return $this->redirect(['controller' => 'usuario','action' => 'ProfileView']);
        }

        $segUsuario = $this->paginate($this->SegUsuario);

        $this->set(compact('segUsuario','lc_role'));
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

        //Redirect students 
        $lc_role = $this->actualRole();
        if( $lc_role == "1")
            return $this->redirect(['controller' => 'usuario','action' => 'ProfileView']);

        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);

        //Administrator can't view superuser information
        if($lc_role == "2" && $segUsuario["ROL"] =="3")
            return $this->redirect(['controller' => 'usuario','action' => 'ProfileView']);

        $this->set('segUsuario', $segUsuario);
    }

    /**
     * Add method
     * @author Esteban Rojas
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lc_role = $this->actualRole();
        //Redirect students 
        if( $lc_role == "1")
        {
            return $this->redirect(['controller' => 'usuario','action' => 'ProfileView']);
        }

        $segUsuario = $this->SegUsuario->newEntity();
        if ($this->request->is('post')) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());

            
       
            $segUsuario["SEG_ROL"] += 1;
            $lc_password = $this-> generatePassword();
            $segUsuario["CONTRASEÑA"] = hash('sha256',$lc_password);

            $lc_code = $this->checkUniqueData($segUsuario["NOMBRE_USUARIO"],$segUsuario["CORREO"]);


            if ($lc_code == "1")
            {
                if ($this->SegUsuario->save($segUsuario)) {
                    $this->Flash->success(__('User was added correctly. Password: ' . $lc_password));


                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__("Error: User can't be added"));
            }
            else 
            {
                if($lc_code == "2")
                {
                    $this->Flash->error(__("Error: The username is already in the system."));
                }
                else
                {
                    $this->Flash->error(__("Error: The email is already in the system."));
                }
            }
        }
        $this->set(compact('segUsuario','lc_role'));
    }

    /**
     * Register method
     * @author Esteban Rojas
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function register()
    {
        $lc_role = $this->actualRole();
        //Redirect students 
        if( $lc_role == "1")
        {
            return $this->redirect(['controller' => 'usuario','action' => 'ProfileView']);
        }

        $segUsuario = $this->SegUsuario->newEntity();
        if ($this->request->is('post')) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());

            
       
            $segUsuario["SEG_ROL"] = 1;
            $lc_password = $this-> generatePassword();
            $segUsuario["CONTRASEÑA"] = hash('sha256',$lc_password);

            $lc_code = $this->checkUniqueData($segUsuario["NOMBRE_USUARIO"],$segUsuario["CORREO"]);


            if ($lc_code == "1")
            {
                if ($this->SegUsuario->save($segUsuario)) {
                    $this->Flash->success(__('User was added correctly. Password: ' . $lc_password));


                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__("Error: User can't be added"));
            }
            else 
            {
                if($lc_code == "2")
                {
                    $this->Flash->error(__("Error: The username is already in the system."));
                }
                else
                {
                    $this->Flash->error(__("Error: The email is already in the system."));
                }
            }
        }
        $this->set(compact('segUsuario','lc_role'));
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
        $lc_role = $this->actualRole();
        //Redirect students 
        if($lc_role == "1")
        {
            return $this->redirect(['controller' => 'usuario','action' => 'ProfileView']);
        }

        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);

        //Administrator can't edit superuser information
        if(($lc_role == "2" && $segUsuario["ROL"] == "3") || $segUsuario["ACTIVO"] == "N")
            return $this->redirect(['controller' => 'usuario','action' => 'ProfileView']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());
            $segUsuario["SEG_ROL"] += 1;

            $lc_code = $this->SegUsuario->checkEditUniqueData($segUsuario["NOMBRE_USUARIO"],$segUsuario["CORREO"],$id);


            if($lc_code == "1") 
            {
                if ($this->SegUsuario->save($segUsuario)) {
                    $this->Flash->success(__('The user information was modified correctly.'));

                    return $this->redirect(['action' => 'index']);
                }
            
            
            $this->Flash->error(__("Error: the user information can't be modified"));
            }
            else
            {
                if($lc_code == "2")
                {
                    $this->Flash->error(__("Error: The username is already in the system."));
                }
                else
                {
                    $this->Flash->error(__("Error: The email is already in the system."));
                }
            }
        }
        $this->set(compact('segUsuario','lc_role'));
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
        //user can only edit his own information
        $id = $this->obtenerUsuarioActual();
        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());


            $lc_code = $this->SegUsuario->checkEditUniqueData($segUsuario["NOMBRE_USUARIO"],$segUsuario["CORREO"],$id);

            if($lc_code == "1") 
            {
                if ($this->SegUsuario->save($segUsuario)) {
                    $this->Flash->success(__('Your information was edited correctly.'));

                    return $this->redirect(['action' => 'ProfileView']);
                }
            
            
                $this->Flash->error(__("Error: Your information can't be edited"));
            }
            else
            {
                if($lc_code == "2")
                {
                    $this->Flash->error(__("Error: The username is already in the system."));
                }
                else
                {
                    $this->Flash->error(__("Error: The email is already in the system."));
                }
            }
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
