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
    public function show($language){
        $this->request->getSession()->write('language',$language);
        $this->set(compact('language'));
        $this->Flash->success('Actual Language: ' . $language . '.');
        return $this->redirect($this->referer());
    }
}
