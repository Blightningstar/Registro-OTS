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
