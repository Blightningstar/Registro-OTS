<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * SolSolicitud Controller
 *
 * @property \App\Model\Table\SolSolicitudTable $SolSolicitud
 *
 * @method \App\Model\Entity\SolSolicitud[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolSolicitudController extends AppController
{
	public function beforeFilter(Event $event)
    {        
        parent::beforeFilter($event);
        $this->set('active_menu', 'MenubarForm');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $solSolicitud = $this->paginate($this->SolSolicitud);

        $this->set(compact('solSolicitud'));
    }
	


    /**
     * View method
     *
     * @param string|null $id Sol Solicitud id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($user_id = null,$course_id = null)
    {
		$applicationTable=$this->loadmodel('SolSolicitud');
		$solSolicitud = $applicationTable->getApplication($user_id,$course_id);

        $this->set('solSolicitud', $solSolicitud);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $solSolicitud = $this->SolSolicitud->newEntity();
        if ($this->request->is('post')) {
            $solSolicitud = $this->SolSolicitud->patchEntity($solSolicitud, $this->request->getData());
            if ($this->SolSolicitud->save($solSolicitud)) {
                $this->Flash->success(__('The sol solicitud has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sol solicitud could not be saved. Please, try again.'));
        }
        $this->set(compact('solSolicitud'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sol Solicitud id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $solSolicitud = $this->SolSolicitud->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solSolicitud = $this->SolSolicitud->patchEntity($solSolicitud, $this->request->getData());
            if ($this->SolSolicitud->save($solSolicitud)) {
                $this->Flash->success(__('The sol solicitud has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sol solicitud could not be saved. Please, try again.'));
        }
        $this->set(compact('solSolicitud'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sol Solicitud id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $solSolicitud = $this->SolSolicitud->get($id);
        if ($this->SolSolicitud->delete($solSolicitud)) {
            $this->Flash->success(__('The sol solicitud has been deleted.'));
        } else {
            $this->Flash->error(__('The sol solicitud could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	 /**
     * getUserApplications
     * @author Esteban Rojas 
     * Calls model to obtains all the user applications
     * @param user_id The user whose applications are required.
     * @return array with all the user applications. Can be empty
     */	
	public function getUserApplications($user_id)
    {
        $userTable=$this->loadmodel('SolSolicitud');
        return $userTable->getUserApplications($user_id);
    }
}
