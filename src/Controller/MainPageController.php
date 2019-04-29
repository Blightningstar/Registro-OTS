<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * MainPage Controller
 *
 *
 * @method \App\Model\Entity\MainPage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MainPageController extends AppController
{
    /**
     * beforeFilter
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * This method runs before any other method of this controller, it sets values to variables
     * that can be used in any view of this módule, in this case sets $active_menu = "MenubarMain"
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('active_menu', 'MenubarMain');
    }

    /**
     * Index
     * @author Nathan González H
     * 
     * Visualization of a background image in the home page of the system.
     */
    public function index()
    {
        
    }
}
