<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\ProProgramaController;
use Cake\Event\Event;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
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
	
    // Vista carga toda la solicitud en labels no inputs y al final estan los botones de acptar,rechazar,atras.
    /**
     * View method
     *
     * @param string|null $id Sol Solicitud id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($usuarioId = null,$cursoId = null) 
    {
        // Acordar borrar esto cuando este bien ligado
        $usuarioId = 3;
        $cursoId = 1;

        // Falta opciones.
        $pregSol = $this->SolSolicitud->getPreguntasFormulario($cursoId);
        $respSol = $this->SolSolicitud->verSolicitud($usuarioId, $cursoId);

        $this->set(compact('pregSol', $pregSol));
        $this->set(compact('respSol', $respSol));
    }

    // Cargar Respuestas
    // Cargar opciones
    // ponerle vacio al select

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($cursoId = null){
        if ($this->request->is('post')) {
            $solicitud = $this->request->getData();
            $preguntas = array_keys($solicitud);
            $respuestas = array_values($solicitud);

            if($this->SolSolicitud->existeSolicitud($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId) == 0)
                $this->SolSolicitud->crearSolicitud($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId);
            else{
                $this->Flash->error("A form for this course is already waiting to be reviewed");
                return $this->redirect(['controller' => 'Dashboard', 'action' => 'studentDashboard']);
            }

            for($iterador = 0; $iterador < sizeof($preguntas); ++$iterador){
                $numPregunta = strtok($preguntas[$iterador], "_");
                $idPregunta = strtok("_");
                $tipoPregunta = strtok("_");

                switch($tipoPregunta){
                    case 0: // Texto corto
                        $this->SolSolicitud->insertarTextoCorto($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break; 
                        
                    case 1: // Texto medio 
                        $this->SolSolicitud->insertarTextoMediano($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 2: // Texto largo
                        $this->SolSolicitud->insertarTextoLargo($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 3: // Número
                        $this->SolSolicitud->insertarNumero($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 4: // Fecha
                        $this->SolSolicitud->insertarFecha($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 5: // Select
                        $this->SolSolicitud->insertarTextoCorto($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 6: // Email
                        $this->SolSolicitud->insertarTextoCorto($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 7: // Teléfono
                        $this->SolSolicitud->insertarTextoCorto($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 8: // Archivo // Revisarlo!!!
                        $fileName = $solicitud[$iterador]['name'];
                        $fileTmpName = $this->request->data[$iterador]['tmp_name'];
                        $fileExt = pathinfo($this->request->data[$iterador]['name'], PATHINFO_EXTENSION);
                        $filePath = 'fileSystem/Sirve/'.$fileName;
                        $uploadState = $this->FileSystem->uploadFile($fileName, $fileTmpName, $filePath, $fileExt);
                        $this->SolSolicitud->insertarArchivo($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;
                }
            }

            $this->Flash->success("The entire form was successfully entered");
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'studentDashboard']);
        }

        $pregSol = $this->SolSolicitud->getPreguntasFormulario($cursoId);
        $this->set(compact('pregSol', $pregSol));

        //Falta cargar opciones
    }

    // Editar es lo mismo solo que en vez de mostrar inputs vacias hay que traer 
            // todos las respuestas antiguas y cargarlas
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

    /**
     * getPercentage
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to get the percentage of answered questions.
     * @param int $course, it's the course id.
     * @param int $student, it's the user id.
     * @return double the percentage of answered questions.
     */
    public function getPercentage($course,$student){
        $formTable = $this->loadModel('SolSolicitud');
        return $formTable->getPercentage($course,$student);
    }
}
