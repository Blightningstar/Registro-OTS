<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;


/**
 * SegUsuario Model
 *
 * @method \App\Model\Entity\SegUsuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\SegUsuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SegUsuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SegUsuario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SegUsuario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SegUsuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SegUsuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SegUsuario findOrCreate($search, callable $callback = null, $options = [])
 */
class SegUsuarioTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('seg_usuario');
        $this->setDisplayField('SEG_USUARIO');
        $this->setPrimaryKey('SEG_USUARIO');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('SEG_USUARIO')
            ->maxLength('SEG_USUARIO', 256)
            ->allowEmptyString('SEG_USUARIO', 'create');

        $validator
            ->scalar('NOMBRE')
            ->maxLength('NOMBRE', 256)
            ->requirePresence('NOMBRE', 'create')
            ->allowEmptyString('NOMBRE', false);

        $validator
            ->scalar('APELLIDO_1')
            ->maxLength('APELLIDO_1', 256)
            ->requirePresence('APELLIDO_1', 'create')
            ->allowEmptyString('APELLIDO_1', false);

        $validator
            ->scalar('APELLIDO_2')
            ->maxLength('APELLIDO_2', 256)
            ->allowEmptyString('APELLIDO_2');

        $validator
            ->scalar('NOMBRE_USUARIO')
            ->maxLength('NOMBRE_USUARIO', 256)
            ->requirePresence('NOMBRE_USUARIO', 'create')
            ->allowEmptyString('NOMBRE_USUARIO', false);

        $validator
            ->scalar('CONTRASEÑA')
            ->maxLength('CONTRASEÑA', 256)
            ->requirePresence('CONTRASEÑA', 'create')
            ->allowEmptyString('CONTRASEÑA', false);

        $validator
            ->scalar('CORREO')
            ->maxLength('CORREO', 256)
            ->requirePresence('CORREO', 'create')
            ->allowEmptyString('CORREO', false);

        $validator
            ->scalar('NUMERO_TELEFONO')
            ->maxLength('NUMERO_TELEFONO', 256)
            ->requirePresence('NUMERO_TELEFONO', 'create')
            ->allowEmptyString('NUMERO_TELEFONO', false);

        $validator
            ->scalar('NACIONALIDAD')
            ->maxLength('NACIONALIDAD', 256)
            ->requirePresence('NACIONALIDAD', 'create')
            ->allowEmptyString('NACIONALIDAD', false);

        $validator
            ->scalar('ACTIVO')
            ->maxLength('ACTIVO', 1)
            ->allowEmptyString('ACTIVO');

        $validator
            ->integer('SEG_ROL')
            ->requirePresence('SEG_ROL', 'create')
            ->allowEmptyString('SEG_ROL', false);

        return $validator;
    }


   /**
     * changeUserActive.
     *  @author Esteban Rojas.
     * Removes logically a user by his id.
     * 
     * @param id The User's id.
     * @param  newActve The new active's value.
     * @return 0 if change failed. Else, return 1.
     */
    public function changeUserActive($id,$newActive)
	{
        $code = 0;
		$connet = ConnectionManager::get('default');
        $result = $connet->execute("update seg_usuario set activo = '$newActive' where seg_usuario = '$id'");
        $code = 1;
        return $code;
    }


    /**
     * checkUniqueData
     *  @author Esteban Rojas.
     *  Checks if the username or email is already in the database.
     * 
     *  @param lc_username The username to search in the database.
     *  @param lc_email The username to search in the database.
     *  @return 1 if email and username don't exist, 2 if user is already on database 3 same, but email isn't.
     */
    public function checkUniqueData($lc_username, $lc_email)
    {
        $lc_code = "1";

        //username and email aren't case sensitive.
        $lc_username = strtolower($lc_username);
        $lc_email = strtolower($lc_email);

        $connet = ConnectionManager::get('default');
        $result = $connet->execute("SELECT LOWER(CORREO) AS CORREO, LOWER(NOMBRE_USUARIO) AS NOMBRE_USUARIO FROM SEG_USUARIO WHERE(CORREO = '$lc_email' or 
        NOMBRE_USUARIO = '$lc_username')");

        $result = $result->fetchAll('assoc');

        //If the query don't fetch any row, then the username and email aren't in the database.
        if(empty($result) == 0)
        {
  
            //Sends a code to determine which data is already in the database: username or email.
            if($result[0]["NOMBRE_USUARIO"] == $lc_username)
            {
                $lc_code = "2";
            }
            else
            {
                if($result[0]["CORREO"] == $lc_email)
                    $lc_code = "3";
            }
        }
 
        return $lc_code;
    }

     /**
     * checkEditUniqueData
     *  @author Esteban Rojas.
     *  Checks if the username or email is already on database. Version for edit user. The difference with the
     *  checkUniqueData is that this function ignores username and email of the actually user.
     *  @param lc_username The username to seatch in the database.
     *  @param lc_email The email to search in the database.
     *  @param lc_us The actually user id.
     *  @return 1 if email and username don't exist, 2 if user is already on database 3 same, but email.
     */
    public function checkEditUniqueData($lc_username, $lc_email, $lc_us)
    {
        $lc_code = "1";
        //username and email aren't case sensitive.
        $lc_username = strtolower($lc_username);
        $lc_email = strtolower($lc_email);

        $connet = ConnectionManager::get('default');
        $result = $connet->execute("SELECT LOWER(CORREO) AS CORREO, LOWER(NOMBRE_USUARIO) AS NOMBRE_USUARIO FROM SEG_USUARIO WHERE((CORREO = '$lc_email' or 
        NOMBRE_USUARIO = '$lc_username') AND SEG_USUARIO != '$lc_us')");

        $result = $result->fetchAll('assoc');

        //If the query don't fetch any row, then the username and email aren't in the database.
        if(empty($result) == 0)
        {
  
            //Sends a code to determine which data is already in the database: username or email.
            if($result[0]["NOMBRE_USUARIO"] == $lc_username)
            {
                $lc_code = "2";
            }
            else
            {
                if($result[0]["CORREO"] == $lc_email)
                    $lc_code = "3";
            }
        }
 
        return $lc_code;
    }


     /**
     * checkUniqueEmail
     *  @author Esteban Rojas
     *  Checks if  email is already on database. Used in profile-edit only, because the user can't edit his username.
     *  so the previous functions can't be used.
     *  @param lc_username The username to search in database.
     *  @param lc_email The email to search in database.
     *  @return 1 if email doesn't exist. Otherwise, return 2.
     */
    public function checkUniqueEmail($lc_username, $lc_email)
    {
        $lc_code = "1";
        //email isn't case sensitive.
        $lc_email = strtolower($lc_email);

        $connet = ConnectionManager::get('default');
        $result = $connet->execute("SELECT LOWER(CORREO) AS CORREO FROM SEG_USUARIO WHERE(CORREO = '$lc_email')");


        $result = $result->fetchAll('assoc');

        //If the query don't fetch any row, then the username and email aren't in the database.
        if(empty($result) == 0)
        {
   
            if($result[0]["CORREO"] == $lc_email)
                $lc_code = "2";
            
        }

        return $lc_code;
    }

    /**
     * getUserRoleByUsername
     * @author Esteban Rojas.
     * Get the user's role. 
     * TODO: Remove this function when user_role is setted as sesion variable. 
     * @param username The username of the user which role must be know.
     * @return "1" = Student, "2" = Administrator, "3" = "Superuser".
     */
    public function getUserRoleByUsername($username)
    {

        $connet = ConnectionManager::get('default');
        $result = $connet->execute("SELECT SEG_ROL FROM seg_usuario where NOMBRE_USUARIO = '$username'");
        $result = $result->fetchAll('assoc');

        return $result[0]["SEG_ROL"];
    }


    /**
     * getHash
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Gets the hashed password from the user known by $username.
     * @param string $username, it's the user identificator.
     * @return string the hashed password of the user.
     */
    public function getHash($username){
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT CONTRASEÑA FROM SEG_USUARIO 
             WHERE NOMBRE_USUARIO = '$username'"
        )->fetchAll('assoc');
        return $result[0]['CONTRASEÑA'];
    }

    /**
     * setHash
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Set the hashed password $hash to the user known by $userdata.
     * @param string $userdata, it's the user identificator.
     * @param string $hash, it's the new hashed password of the user.
     */
    public function setHash($userdata,$hash){
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "UPDATE SEG_USUARIO SET CONTRASEÑA = '$hash'
             WHERE NOMBRE_USUARIO = '$userdata' OR CORREO = '$userdata'"
        );
    }

    /**
     * getCode
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Get the restauration code from the user known by his $email.
     * @param string $email, it's the user identificator.
     * @return string the restauration code of the user.
     */
    public function getCode($email){
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT CÓDIGO_RESTAURACIÓN FROM SEG_USUARIO
             WHERE CORREO = '$email'"
        )->fetchAll('assoc');
        return $result[0]['CÓDIGO_RESTAURACIÓN'];
    }


    /**
     * setCode
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Set the restauration code to the user known by his $email.
     * @param string $email, it's the user identificator.
     * @param string $code, it's the new restauration code of the user.
     */
    public function setCode($email,$code){
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "UPDATE SEG_USUARIO SET CÓDIGO_RESTAURACIÓN = '$code'
             WHERE CORREO = '$email'"
        );
    }


    /**
     * getEmailByUserData
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Verifies the existence of the user and returns its email.
     * @param string $userdata, it's the user email or username.
     * @return string the user email.
     */
    public function getEmailByUserData($userdata){
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT CORREO FROM SEG_USUARIO
             WHERE NOMBRE_USUARIO = '$userdata' OR CORREO = '$userdata'"
        )->fetchAll('assoc');
        if($result){
            return $result[0]['CORREO'];
        }else{
            return $result;
        }
    }

    /**
     * getUser
     * @author Daniel Marín <110100010111h@gmail.com>
     * TODO: Search more secure method (inyection)
     * 
     * Verifies the existence of the user and returns its data.
     * @param string $userdata, it's the user email or username.
     * @return string the user email.
     */
    public function getUser($userdata,$hash){
        $connect = ConnectionManager::get('default');
        $result = $connect->execute(
            "SELECT * FROM SEG_USUARIO
             WHERE CONTRASEÑA = '$hash' AND (NOMBRE_USUARIO = '$userdata' OR CORREO = '$userdata')"
        )->fetchAll('assoc');
        if($result){
            return $result[0];
        }else{
            return $result;
        }
    }
}
