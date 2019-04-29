<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
    }
    
    /** 
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * This method runs before any other method of any controller, it sets values to variables
     * that can be used in any place of the program, for example the user data, it's set to null 
     * if there's no any
     * 
     */
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $actualUser = $this->getRequest()->getSession()->read('actualUser');
        $this->set(compact('actualUser'));
        
        $country = $this->getRequest()->getSession()->read('country');
        $country = $this->getLocation();//TODO: Eliminar esta linea a la hora de desplegar la página
        if(!$country){
            $country = $this->getLocation();
            $this->request->getSession()->write('country',$country);
            $language = ($country == 'CR'? "Español" : "English");
            $this->request->getSession()->write('language',$language);
        }
        $language = $this->getRequest()->getSession()->read('language');
        $this->set(compact('language'));
        $this->set(compact('country'));
    }


    /** 
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Gets the current user country using his ip
       because whe are working on localhost this is simulated by given ip addresses
     * 
     * @return string the country where the user is defined by his ip
     */
    public function getLocation(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        
        //TODO: Borrar las lineas IP siguientes, debido a la falta de ip por trabajar en localhost se utilizan las siguientes para simular la ubicación
        // Ip Costa Rica
        $ip = "190.171.106.117";
        // Ip Sudafrica
        //$ip = "41.85.255.255";
        
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        return $details->country;
    }
}
