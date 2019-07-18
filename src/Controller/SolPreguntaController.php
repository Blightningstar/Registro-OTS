<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * SolPregunta Controller
 *
 * @property \App\Model\Table\SolPreguntaTable $SolPregunta
 *
 * @method \App\Model\Entity\SolPreguntum[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolPreguntaController extends AppController
{
    /**
     * beforeFilter
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     * This method runs before any other method of this controller, it sets values to variables
     * that can be used in any view of this módule, in this case sets $active_menu = "MenubarQuestions"
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('active_menu', 'MenubarQuestions');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        // The user have the permission for this action?
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(27, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

        $solPregunta = $this->paginate($this->SolPregunta);
        $this->set(compact('solPregunta'));
    }

    /**
     * View method
     *
     * @param string|null $id Sol Preguntum id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $solPreguntum = $this->SolPregunta->get($id, [
            'contain' => []
        ]);

        $this->set('solPreguntum', $solPreguntum);

        $options = $this->SolPregunta->getOptions($solPreguntum['SOL_PREGUNTA']);
        // var_dump($options);
        $this->set('options', $options);
    }

    /**
     * Add method
     * @author Joel Chaves 
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $solPreguntum = $this->SolPregunta->newEntity();
        if ($this->request->is('post')) {
            $solPreguntum = $this->SolPregunta->patchEntity($solPreguntum, $this->request->getData());
            $temp = $this->request->getData();

            if ($this->SolPregunta->insertarPregunta($temp['DESCRIPCION_ING'],$temp['tipo'],$temp['ACTIVO'], $temp['REQUERIDO'])) {
                $this->Flash->success(__('The question has been saved.'));

                if ($temp['tipo'] == 5 && $this->SolPregunta->insertOptions($this->SolPregunta->returnMaxSolPregunta()-1, $temp['options'])) {
                    $this->Flash->success(__('The options have been saved.'));
                    
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $this->set(compact('solPreguntum'));

        $ACTIVO = array('Inactive','Active');
        $this->set('ACTIVO',$ACTIVO);

        $REQUERIDO = array('Not required','Required');
        $this->set('REQUERIDO',$REQUERIDO);

         $TIPO = array('Short Text','Medium Text','Large text','Number','Date','Select','Email','Phone','number','URL');
         $this->set('TIPO',$TIPO);
    }

    /**
     * Edit method
     * @author Joel Chaves 
     * @param string|null $id Sol Preguntum id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $solPreguntum = $this->SolPregunta->get($id, [
            'contain' => []]);
        $temp = $this->request->getData();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solPreguntum = $this->SolPregunta->patchEntity($solPreguntum, $this->request->getData());
            
            if ($this->SolPregunta->editarPregunta($solPreguntum['SOL_PREGUNTA'], $temp['DESCRIPCION_ING'],$temp['tipo'],$temp['ACTIVO'], $temp['REQUERIDO'])) {
                $this->Flash->success(__('The question has been saved.'));

                if ($temp['tipo'] == 5 && $this->SolPregunta->insertOptions($solPreguntum['SOL_PREGUNTA'], $temp['options'])) {
                    $this->Flash->success(__('The options have been saved.'));   
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $this->set(compact('solPreguntum'));

        $ACTIVO = array('Inactive','Active');
         $this->set('ACTIVO',$ACTIVO);

         $REQUERIDO = array('Not required','Required');
         $this->set('REQUERIDO',$REQUERIDO);

         $TIPO = array('Text','Number','Date', 'Select');
         $this->set('TIPO',$TIPO);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sol Preguntum id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id )
    {
        // The user have the permission for this action?
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(8, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

         if ($this->desactivarPregunta($id)) {
             $this->Flash->success(__('The question active state has been changed'));
         } else {
             $this->Flash->error(__('The question could not be deleted. Please, try again.'));
         }

        return $this->redirect(['action' => 'index']);
    }

    /**
     *  Invokes desactivarPregunta() from the Table
     *  @author Joel Chaves
     *  @param int $id, it's the question identifier
     *  @return 1 when succeded
     */

    public function desactivarPregunta ($id)
    {
        $solPreguntaTable = $this->loadmodel('SolPregunta');
        $solPreguntaTable->desactivarPregunta($id);
        return 1;
    }

    public function getPreguntas() {
        $userTable=$this->loadmodel('SolPregunta');
        return $userTable->getPreguntas();
    }
}