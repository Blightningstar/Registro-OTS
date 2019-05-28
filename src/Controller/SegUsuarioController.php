<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Event\Event;

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
     * beforeFilter
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * This method runs before any other method of this controller, it sets values to variables
     * that can be used in any view of this módule, in this case sets $active_menu = "MenubarUsers"
     */
    public function beforeFilter(Event $event)
    {        
        parent::beforeFilter($event);
        $this->set('active_menu', 'MenubarUsers');
    }
    
    /**
     *  checkUniqueData.
     *  @author Esteban Rojas.
     *  Calls the users model to check if the username or email is already on database.
     * 
     *  @param lc_username The username to search in the database.
     *  @param lc_email The email to search in the database.
     *  @return 1 if email and username don't exist, 2 if user is already on database 3 same, but email isn't.
     */
    function checkUniqueData($lc_username, $lc_email)
    {
        return $this->SegUsuario->checkUniqueData($lc_username, $lc_email);
    }

    /**
     * generatePassword
     * @author Esteban Rojas.
     * Generates a 18 length random password.
     * 
     * @return new password as string.
     */
    function generatePassword()
    {
        $lc_newPassword= "";

        //Create 18 randoms characters
        for($lc_iteration = 0; $lc_iteration < 18; $lc_iteration = $lc_iteration + 1)
        {
            $ln_random = rand(65,90);
            
            if(rand(0,1) == 0)
                $ln_random = $ln_random + 32; // Sometimes set upper character
            else if(rand(0,1) == 0)
                $lc_character = chr(rand(50,56)); //Sometimes it will be a number.

            $lc_character = chr($ln_random);
            $lc_newPassword = $lc_newPassword . $lc_character;
        }
        $lc_newPassword = $lc_newPassword . chr(rand(50,56));

 
        return $lc_newPassword;
    }

    /**
     * getActualUsername
     * @author EstebanRojas.
     * Obtains the username of the authenticated user.
     * 
     * @return Username of authenticated user.
     */
    function getActualUsername()
    {
        $actualUser = $this->viewVars['actualUser'];
        return $actualUser["NOMBRE_USUARIO"];
    }

    /**
     * actualRole
     * @author Esteban Rojas
     * 
     * Get the authenticated user role.
     * @return "1" => student, "2" => "Administrator", "3" => "Superuser", or redirect to login if user is not logged
     */
    function actualRole()
    {
        if(empty($this->viewVars['actualUser']) == 1)
            return $this->redirect(['controller' => 'seguridad','action' => 'login']);
        return $this->viewVars['actualUser']['SEG_ROL'];
    }


    /**
     * Index method
     * @author Esteban Rojas.
     * Calls the index view.
     * 
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $actualUserName = $this->viewVars['actualUser']["NOMBRE_USUARIO"];
        $lc_role = $this->actualRole();
        //Redirect students 
        if($lc_role == "1")
        {
            return $this->redirect(['controller' => 'usuario','action' => 'ProfileView']);
        }
        
        $segUsuario = $this->paginate($this->SegUsuario);

        $this->set(compact('segUsuario','lc_role','actualUserName'));
    }

    /**
     * View method
     * @author Esteban Rojas.
     * Calls the view view.
     * 
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

        //Allow user edit only if the user is active.
        if($segUsuario["ACTIVO"] == "0")
        {
            $this->Flash->error(__("Error: The user is inactive."));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('segUsuario', $segUsuario);
    }

    /**
     * Add method
     * @author Esteban Rojas
     * Calls add view or capture add information when submitted. Students, Administrators and Superusers
     * can be created in this view.
     * 
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

        //Only executed when user submitted a form.
        if ($this->request->is('post')) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());
       
            //To fix index mismatch.
            $segUsuario["SEG_ROL"] += 1;

            $user_c = new SeguridadController;

            //Creates a new password for the user.
            $lc_password = $this-> generatePassword();
            $segUsuario["CONTRASENA"] = $user_c->hash($lc_password);
            

            //Verifies if username and email aren't in the database.
            $lc_code = $this->checkUniqueData($segUsuario["NOMBRE_USUARIO"],$segUsuario["CORREO"]);

            //The code will be used to control if the username or email are in the dabase.
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
     * Register method. 
     * @author Esteban Rojas.
     * Calls register view or capture add information when submitted. Only students can register themselves.
     * Superusers and administrators must be created in the add view.
     * 
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function register()
    {

        $this->set('active_title', 'TitlebarSignUp');
        $segUsuario = $this->SegUsuario->newEntity();

        //Only executed if user submitted a form.
        if ($this->request->is('post')) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());

            //Set student role for the new user.
            $segUsuario["SEG_ROL"] = 3;


            $user_c = new SeguridadController;
            $credentials = $this->request->getData();
       
            //Verifies than the two new passwords written by the user are equal.
            $samePasswords = $credentials['new_password'] == $credentials['new_password_confirmation'];
            
            //lc_code will indicate if the username or email exists.
            $lc_code = $this->checkUniqueData($segUsuario["NOMBRE_USUARIO"],$segUsuario["CORREO"]);
        
            if(!$samePasswords)
            {
                $this->Flash->error('New password and its confirmation doesn\'t match.');
            }
            else
            {
                $segUsuario["CONTRASENA"] = $user_c->hash($credentials['new_password']);
                // $segUsuario["SEG_USUARIO"] = 1;
                //debug($segUsuario);
                //Uses lc_code to control the action to do.
                if ($lc_code == "1")
                {
                    $email_controller = new EmailController;
                    
                    if($email_controller->sendEmail($segUsuario["CORREO"],"Register",$segUsuario)){
                        if ($this->SegUsuario-> insertUser($segUsuario)) {
                            $this->Flash->success(__('Your user account was created.'));
                            
                            
                            return $this->redirect(['controller' => 'Seguridad','action' => 'login']);
                        }
                    }else{
                        $this->Flash->error(__("Error: Email doesn't exists"));
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
        }
        $this->set(compact('segUsuario','lc_role'));
    }

    /**
     * Edit method
     * @author Esteban Rojas
     * Calls Edit view or capture add information when submitted.
     * 
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

        //Obtains the user data to put in the fields.
        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);

        //Allow user edit only if the user is active.
        if($segUsuario["ACTIVO"] == "0")
        {
            $this->Flash->error(__("Error: The user is inactive."));
            return $this->redirect(['action' => 'index']);
        }

        //Administrator can't edit superuser information
        if(($lc_role == "2" && $segUsuario["ROL"] == "3") || $segUsuario["ACTIVO"] == "N")
            return $this->redirect(['controller' => 'usuario','action' => 'ProfileView']);

        //Executed only if user submitted a form.
        if ($this->request->is(['patch', 'post', 'put'])) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());
            $segUsuario["SEG_ROL"] += 1;
   
            //lc_code will control if username or email are in the database. Excludes username and email of the edited user.
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


    /** 
     * obtenerUsuarioActual.
     * @author Esteban Rojas.
     * Obtains authenticated user id
     * 
     * @return String username.
     */
    public function obtenerUsuarioActual()
    {
        $actualUser = $this->viewVars['actualUser'];
        return $actualUser['SEG_USUARIO'];
    }

    /**
     * @author Esteban Rojas
     * Calls Profile-edit view or capture add information when submitted. The user can't edit his username or 
     * his role.
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function profileEdit($id = null)
    {
        //user can only edit his own information.
        $id = $this->obtenerUsuarioActual();
        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);

        //Executed only if user submitted a form.
        if ($this->request->is(['patch', 'post', 'put'])) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());

            //lc_code will control if username or email are in the database. Excludes username and email of the edited user.
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
     * profileView
     * @author Esteban Rojas.
     * In this view the user can only view his information.
     * 
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function profileView($id = null)
    {
        $this->set('active_title', 'TitlebarUser');

        //Obtain authenticated user id.
        $id = $this->obtenerUsuarioActual();

        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);

        $this->set('segUsuario', $segUsuario);
    }

    /**
     * 
     * @author Esteban Rojas
     * Change the active status of the user
     * 
     * @param id user id
     * @param active the new active value
     * @return true/false 
     */
    public function changeUserActive($id,$active)
    {
        return $this->SegUsuario->changeUserActive($id,$active);
    }

    /**
     * Delete method
     * @author Esteban Rojas
     * Remove logically a user. A user can't remove himself. The system can't be without superusers because
     * the last superuser can't remove himself. Administrators can't remove superusers.
     * 
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->getData();

        $segUsuario = $this->SegUsuario->get($id);
        if ($this->changeUserActive($id,$data['newActive'])) {
            $this->Flash->success(__('The user active value was modified correctly.'));
        } else {
            $this->Flash->error(__("Error: An user can't remove himself from the system."));
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
     * Calls its model function to get the email of the user known by $userdata.
     * @param string $userdata, it's the user email or username.
     * @return string the user email.
     */
    public function getEmailByUserData($userdata){
        $userTable=$this->loadmodel('SegUsuario');
        return $userTable->getEmailByUserData($userdata);
    }

    /**
     * getUser
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to get all the user data.
     * @param string $userdata, it's the user email or username.
     * @return string all the user data.
     */
    public function getUser($userdata){
        $userTable=$this->loadmodel('SegUsuario');
        return $userTable->getUser($userdata);
    }
}
