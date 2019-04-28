<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;
use Cake\Event\Event;

/**
 * Seguridad Controller
 * @author Daniel Marín <110100010111h@gmail.com>
 *
 * @method \App\Model\Entity\Seguridad[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SeguridadController extends AppController
{


    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('active_title', 'LogIn');
    }

    /**
     * login
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Start a new session for the authentified user.
     * @return \Cake\Http\Response|null Redirects if the user credentials are correct, renders view otherwise.
     */
    public function login()
    {        
        $actualUser = $this->viewVars['actualUser'];
        if(!$actualUser){
            if($this->request->is('post')){
                $user_c = new SegUsuarioController;
                $credentials = $this->request->getData();
                $userdata = $credentials['email'];
                $hash = $this->hash($credentials['password']);
                $user = $user_c->getUser($userdata,$hash);
                if($user){
                    $actualUser = $user;
                    $this->request->getSession()->write('actualUser',$actualUser);
                    $this->set(compact('actualUser'));
                    $this->Flash->success('Logged in succefully.');
                    return $this->redirect(['controller'=>'MainPage','action' => 'index']);
                    
                }else{
                    $this->Flash->error('The username or the password are incorrect, please try again.');
                }                
            }
        }else{
            $this->Flash->error('You are already logged in.');
            return $this->redirect(['controller'=>'MainPage','action' => 'index']);

        }
    }

    /**
     * logout
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * Finishes actual session.
     * @return \Cake\Http\Response.
     */
    public function logout()
    {
        $actualUser = $this->viewVars['actualUser'];
        if($actualUser){
            $this->request->getSession()->write('actualUser',null);
            $this->set(compact('actualUser'));
            $this->Flash->success('You are now logged out.');

            //TODO: chose where to redirect
            
            return $this->redirect(['action' => 'login']);

        }else{
            $this->Flash->error('You have not logged in.');
            return $this->redirect(['controller'=>'MainPage','action' => 'index']);
        }
    }

    /**
     * restoreSend
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * Checks if the given user exists, sends an email with a restauration code and 
     * saves the restauration code on the database for the given user.
     * @return \Cake\Http\Response|null Redirects if the user exists, renders view otherwise.
     */
    public function restoreSend()
    {
        $actualUser = $this->viewVars['actualUser'];
        if(!$actualUser){
            if($this->request->is('post')){            
                $user_c = new SegUsuarioController;
                $code = Security::randomString(15);
                $data = $this->request->getData();
                $email = $user_c->getEmailByUserData($data['username']);
                if($email){
                    $user_code = $user_c->getCode($email);
                    if(!$user_code){
                        
                        // TODO: send mail

                        $user_c->setCode($email,$code);
                        $this->Flash->success('Code sent to ' . $email . '.');
                       
                        return $this->redirect(['action' => 'restoreVerify', $email]);

                    }else if($user_code){

                        // TODO: Change error message to a warning message, fix warning bug.
                        // $this->Flash->warning('Code already sent, please check the email.');

                        $this->Flash->error('Code already sent  to ' . $email . ', please check your email.');                    
                       
                        return $this->redirect(['action' => 'restoreVerify', $email]);

                    }
                }else{
                    $this->Flash->error('The user doesn\'t exist.');
                }
            }
        }else{
            $this->Flash->error('You are already logged in.');
            return $this->redirect(['controller'=>'MainPage','action' => 'index']);

        }
    }

    /**
     * restoreVerify
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * change tha actual password for a new one with a restauration code.
     * @return \Cake\Http\Response|null Redirects on successful change, renders view otherwise.
     */
    public function restoreVerify($email)
    {
        $actualUser = $this->viewVars['actualUser'];
        if(!$actualUser){
            if($this->request->is('post')){
                $user_c = new SegUsuarioController;
                $credentials = $this->request->getData();            
                $condition1 = $credentials['new_password'] == $credentials['password_confirmation'];
                $condition2 = $user_c->getCode($email) == $credentials['code'];
                $all_conditions = $condition1 && $condition2;
                if(!$condition1)
                    $this->Flash->error('New password and its confirmation doesn\'t match.');
                else if(!$condition2)
                    $this->Flash->error('Wrong restauration code.');
                else if($all_conditions){
                    $new_pass = $this->hash($credentials['new_password']);
                    $user_c->setHash($email,$new_pass);
                    $user_c->setCode($email,null);
                    $this->Flash->success('Password Changed Correctly.');
                    
                    return $this->redirect(['action' => 'login']);

                }
            }
        }else{
            $this->Flash->error('You are already logged in.');
            return $this->redirect(['controller'=>'MainPage','action' => 'index']);
        }
    }

    /**
     * change
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * Changes the actual user password for a new one.
     * @return \Cake\Http\Response|null Redirects on successful change or if user not logged, renders view otherwise.
     */
    public function change()
    {
        $user = $this->viewVars['actualUser'];
        if($user){
            
            if($this->request->is('post')){
                $user_c = new SegUsuarioController;
                $credentials = $this->request->getData();
                $old_pass = $user_c->getHash($user['NOMBRE_USUARIO']);
            
                $condition1 = $credentials['new_password'] == $credentials['new_password_confirmation'];
                $condition2 = $this->check($credentials['old_password'],$old_pass);
                $condition3 = $credentials['old_password'] != $credentials['new_password'];
                $all_conditions = $condition1 && $condition2 && $condition3;
                if(!$condition1)
                    $this->Flash->error('New password and its confirmation doesn\'t match.');
                else if(!$condition2)
                    $this->Flash->error('Wrong old password.');
                else if(!$condition3)
                    $this->Flash->error('New password can\'t be the same as old password.');
                else if($all_conditions){
                    $new_pass = $this->hash($credentials['new_password']);
                    $user_c->setHash($user['NOMBRE_USUARIO'],$new_pass);
                    $this->Flash->success('Password Changed Correctly.');
                   
                    return $this->redirect(['controller'=>'SegUsuario','action' => 'profile_view', $user['SEG_USUARIO']]);

                }
            }
        }else{
            $this->Flash->error('You have not logged in.');

            // TODO: elegir donde redirigir: a la página principal o a la página anterior o a la página de logueo
            //return $this->redirect($this->referer());
            
            return $this->redirect(['action' => 'login']);
        }
    }

    /**
     * hash
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * hash the given plain text password and returns it.
     * @param string $password, the plain text string to be hashed.
     * @return string the hashed password.
     */
    public function hash($password)
    {
        // TODO: Mejorar método de encripción debido a inseguridad de sha256
        $sha256 = Security::hash($password, 'sha256');
        return $sha256;
    }

    /**
     * check
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * Generate hash for the user provided password and check against the existing hash.
     * @param string $password, the plain text string to be hashed.
     * @param string $hashed, existing hashed password.
     * @return bool true if both match, else false.
     */
    public function check($password,$hashed)
    {
        return $this->hash($password) === $hashed;
    }
}
