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
    /**
     * login
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Verifies if there is any logged user:
     *  - If there is then starts a redirection and flash a message.
     *  - Else it waits for the user credentials to be post and checks if 
     *    the user exists, then starts a new session for the authentified user.
     * 
     * @return \Cake\Http\Response|null Redirects if the user credentials are correct, renders view otherwise.
     */
    public function login(){
        $this->set('active_title', 'TitlebarSignIn');
        $actualUser = $this->viewVars['actualUser'];
        if(!$actualUser){
            if($this->request->is('post')){
                $credentials = $this->request->getData();
                $userdata = $credentials['email'];
                $pasword = $credentials['password'];

                $userController = new SegUsuarioController;
                $actualUser = $userController->getUser($userdata);
                if(!$actualUser)
                    $this->Flash->error(__('The username or the password are incorrect, please try again.'));
                else{
                    $hash = $actualUser['CONTRASEÑA'];              
                    if(!$this->check($userdata,$pasword,$hash))
                        $this->Flash->error(__('The username or the password are incorrect, please try again.'));
                    else{
                        $this->request->getSession()->write('actualUser',$actualUser);
                        $this->set(compact('actualUser'));
                        $this->Flash->success('Logged in succefully.');
                        return $this->redirect(['controller'=>'MainPage','action' => 'index']);
                    }
                }
           }
        }else{
            $this->Flash->error('You are already logged in.');
            return $this->redirect($this->referer());
        }
    }

    /**
     * logout
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * Deletes the actual user data and finishes the actual session, it doesn't
     * deletes nothing if the user has not logged in.
     * 
     * @return \Cake\Http\Response.
     */
    public function logout()
    {
        $actualUser = $this->viewVars['actualUser'];
        if($actualUser){
            $this->request->getSession()->write('actualUser',null);
            $this->set(compact('actualUser'));
            $this->Flash->success('You are now logged out.');
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
     * saves the restauration code on the database for the given user, it doesn't 
     * sends nothing if the user doesn\'t exist or if the user is already logged in.
     * 
     * @return \Cake\Http\Response|null Redirects if the user exists, renders view otherwise.
     */
    public function restoreSend(){
        $actualUser = $this->viewVars['actualUser'];
        if(!$actualUser){
            if($this->request->is('post')){            
                $userController = new SegUsuarioController;
                $code = Security::randomString(15);
                $data = $this->request->getData();
                $email = $userController->getEmailByUserData($data['username']);
                if($email){
                    $user_code = $userController->getCode($email);
                    if(!$user_code){
                        $userController->setCode($email,$code);
                        $this->Flash->success('Code sent to ' . $email . '.' . $code);
                        return $this->redirect(['action' => 'restoreVerify', $email]);
                    }else if($user_code){
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
     * change tha actual password for a new one requiring a restauration code.
     * 
     * @return \Cake\Http\Response|null Redirects on successful change, renders view otherwise.
     */
    public function restoreVerify($email)
    {
        $actualUser = $this->viewVars['actualUser'];
        if(!$actualUser){
            if($this->request->is('post')){
                $userController = new SegUsuarioController;
                $credentials = $this->request->getData();            
                $condition1 = $credentials['new_password'] == $credentials['password_confirmation'];
                $condition2 = $userController->getCode($email) == $credentials['code'];
                $all_conditions = $condition1 && $condition2;
                if(!$condition1)
                    $this->Flash->error('New password and its confirmation doesn\'t match.');
                else if(!$condition2)
                    $this->Flash->error('Wrong restauration code.');
                else if($all_conditions){
                    $new_pass = $this->hash($credentials['new_password']);
                    $userController->setHash($email,$new_pass);
                    $userController->setCode($email,null);
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
     * 
     * @return \Cake\Http\Response|null Redirects on successful change or if user not logged, renders view otherwise.
     */
    public function change()
    {
        $user = $this->viewVars['actualUser'];
        if($user){
            if($this->request->is('post')){
                $userController = new SegUsuarioController;
                $credentials = $this->request->getData();
                $old_pass = $userController->getHash($user['NOMBRE_USUARIO']);
            
                $condition1 = $credentials['new_password'] == $credentials['new_password_confirmation'];
                $condition2 = $this->check($user['NOMBRE_USUARIO'],$credentials['old_password'],$old_pass);
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
                    $userController->setHash($user['NOMBRE_USUARIO'],$new_pass);
                    $this->Flash->success('Password Changed Correctly.');
                    return $this->redirect(['controller'=>'SegUsuario','action' => 'profile_view', $user['SEG_USUARIO']]);
                }
            }
        }else{
            $this->Flash->error('You have not logged in.');            
            return $this->redirect(['action' => 'login']);
        }
    }

    /**
     * hash
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * Uses becypt with 0.2(200 miliseconds) as timeTarget,
     * hash the given plain text password and returns it.
     * 
     * @param string $password, the plain text string to be hashed.
     * @return string the hashed password.
     */
    public function hash($password){
        $cost = $this->calculateCost(0.2);
        $options = ['cost'=>$cost];
        $bcrypt = password_hash($password, PASSWORD_BCRYPT, $options);
        return $bcrypt;
    }

    /**
     * check
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * Verifies the password and checks if it needs to be rehashed.
     * 
     * @param string $userdata, The username or email in case of rehashing th password.
     * @param string $password, the plain text string to be hashed.
     * @param string $hashed, existing hashed password.
     * @return bool true if password match, else false.
     */
    public function check($userdata,$password,$hash){
        if(password_verify($password, $hash)){
            $cost = $this->calculateCost(0.2);
            $options = ['cost' => $cost];
            if (password_needs_rehash($hash, PASSWORD_DEFAULT, $options)) {
                $newHash = $this->hash($password);
                $userController = new SegUsuarioController;
                $userController->setHash($userdata,$newHash);
            }
            return true;
        }
        return false;
    }

    /**
     * calculateCost
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * Calculates the cost necessary to obtain the target time on the hashing algorithm.
     * 
     * @param double $timeTarget, the time that we want on the hashing algorithm.
     * @return int the cost to accomplish that time.
     */
    public function calculateCost($timeTarget){
        $cost = 8;
        do {
            $cost++;
            $start = microtime(true);
            password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
            $end = microtime(true);
        } while (($end - $start) < $timeTarget);
        return $cost;
    }
}
