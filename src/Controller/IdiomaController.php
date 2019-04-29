<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Idioma Controller
 *
 *
 * @method \App\Model\Entity\Idioma[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IdiomaController extends AppController
{
    /**
     * change
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * Changes the actual language var to be used on the future as a language toggler between english and spanish
     */
    public function change(){
        $language = $this->getRequest()->getSession()->read('language');
        $language = ($language == "Español"? "English":"Español");
        $this->request->getSession()->write('language',$language);
        $this->set(compact('language'));
        $this->Flash->success('Language changed to: ' . $language . '.');
        return $this->redirect($this->referer());
    }
}
