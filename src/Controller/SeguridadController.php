<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;

/**
 * Seguridad Controller
 * 
 *
 * @method \App\Model\Entity\Seguridad[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SeguridadController extends AppController
{

    /**
     * login
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * 
     */
    public function login()
    {
        // TODO: verificar que el usuario ha ingresado al sistema acá

        if($this->request->is('post'))
        {
            $credentials = $this->request->getData();
            $pass = $this->encrypt($credentials['password']);
            debug($credentials);
            debug($pass);
            die();

            //TODO: Comprobar datos del log acá, utilizar el modelo de segUsuario(dependencia, implica fusionar) y setear usuario actual
            //TODO: Investigar $This->Auth
            //TODO: Redirigir a la página principal
        }
    }

    /**
     * restore
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * 
     */
    public function restore()
    {
        // TODO: Vista con pop up para verificar codigo enviado
        if($this->request->is('post'))
        {
            $credentials = $this->request->getData();
            //$pass = $this->encrypt($credentials['password']);
            debug($credentials);
            //debug($pass);
            die();
        }
    }

    
    /**
     * change
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * 
     */
    public function change()
    {
        if($this->request->is('post'))
        {
            // TODO: verficar y encriptar datos
            $credentials = $this->request->getData();
            //$pass = $this->encrypt($credentials['password']);
            debug($credentials);
            //debug($pass);
            die();
        }
    }

    
    /**
     * encrypt
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * 
     */
    public function encrypt($password)
    {
        // TODO: Mejorar método de encriptación debido a inseguridad de sha256
        $salt = "elegir";
        $sha256 = Security::hash($password, 'sha256');
        return $sha256;
    }
}
