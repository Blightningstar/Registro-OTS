<?php
namespace App\Controller;

use App\Controller\AppController;

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
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
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
            

            if ($this->SolPregunta->insertarPregunta($temp['DESCRIPCION_ESP'],$temp['DESCRIPCION_ING'],$temp['TIPO'],$temp['ACTIVO'], $temp['REQUERIDO'])) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $this->set(compact('solPreguntum'));

        $ACTIVO = array('Active','Inactive');
         $this->set('ACTIVO',$ACTIVO);

         $REQUERIDO = array('Required','Not requered');
         $this->set('REQUERIDO',$REQUERIDO);

         $TIPO = array('Text','Number','Date', 'Select');
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
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solPreguntum = $this->SolPregunta->patchEntity($solPreguntum, $this->request->getData());
            if ($this->SolPregunta->save($solPreguntum)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $this->set(compact('solPreguntum'));

        $ACTIVO = array('Active','Inactive');
         $this->set('ACTIVO',$ACTIVO);

         $REQUERIDO = array('Required','Not requered');
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
         if ($this->desactivarPregunta($id)) {
             $this->Flash->success(__('The question has been deleted.'));
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
}