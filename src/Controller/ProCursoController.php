<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\ProProgramaController;
/**
 * ProCurso Controller
 * @author Jason Zamora Trejos
 * @property \App\Model\Table\ProCursoTable $ProCurso
 *
 * @method \App\Model\Entity\ProCurso[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProCursoController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $proCurso = $this->paginate($this->ProCurso);
        $this->loadModel('pro_programa');
        $this->set(compact('proCurso'));
    }

    /**
     * View method
     *
     * @param string|null $id Pro Curso id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $proCurso = $this->ProCurso->get($id, [
            'contain' => []
        ]);

        $this->set('proCurso', $proCurso);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //$programaTable = $this->loadModel('pro_programa');
        
        //$limit = $this->mirrorDate($proCurso['FECHA_LIMITE']);
        /*// Converting the query to a key-value array will also execute it.
        $vlc_DsPrograma = toArray();*/
        $proCurso = $this->ProCurso->newEntity();
        if ($this->request->is('post')) {
            $proCurso = $this->ProCurso->patchEntity($proCurso, $this->request->getData());
            $form_data = $this->request->getData();
//            debug($form_data);
//            die();
 //           $limit = $this->mirrorDate($proCurso['FECHA_LIMITE']);
            $limit = $form_data['FECHA_LIMITE'];
           // debug($limit);
            //die();
            $end = $form_data['FECHA_FINALIZACION'];
            $start = $form_data['FECHA_INICIO'];
            //$vlc_DsPrograma = $this->ProPrograma->patchEntity($proPrograma, $this->request->getData());
            if ($this->ProCurso->save($proCurso, $start, $end, $limit)) {
                $this->Flash->success(__('The curso has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The curso could not be saved. Please, try again.'));
        }
        $this->set(compact('proCurso'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pro Curso id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $proCurso = $this->ProCurso->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proCurso = $this->ProCurso->patchEntity($proCurso, $this->request->getData());
            $form_data = $this->request->getData();
            //debug($form_data);
            //debug($proCurso);
            //die();
            // TODO: verificar que la llave colocada en form_data("pro_curso") está disponible
            // TODO: alterar la llave de $proCurso("PRO_CURSO") = form_data("pro_curso")
            if ($this->ProCurso->save($proCurso)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $this->set(compact('proCurso'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pro Curso id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $proCurso = $this->ProCurso->get($id);
        if ($this->ProCurso->delete($proCurso)) {
            $this->Flash->success(__('The course has been deleted.'));
        } else {
            $this->Flash->error(__('The course could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
