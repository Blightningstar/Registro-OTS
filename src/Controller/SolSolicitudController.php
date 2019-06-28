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
        $cursoId = 8;

        $this->loadModel('SolFormulario');

        $pregSol = $this->SolFormulario->getPreguntasFormulario($cursoId);
        $respSol = $this->SolSolicitud->verSolicitud($usuarioId, $cursoId);

        $this->set(compact('pregSol', $pregSol));
        $this->set(compact('respSol', $respSol));
        // Faltan  botones de aceptar, rechazar y volver.
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($cursoId = null){
        if ($this->request->is('post')) {
            $this->loadModel('ProCurso');
            $this->loadModel('SolArchivo');
            $this->loadModel('SolFecha');
            $this->loadModel('SolNumero');
            $this->loadModel('SolTextoCorto');
            $this->loadModel('SolTextoMedio');
            $this->loadModel('SolTextoLargo');

            $solicitud = $this->request->getData();
            $preguntas = array_keys($solicitud);
            $respuestas = array_values($solicitud);

            $foldername = 'FileSystem/'.$this->ProCurso->getProgramaName($cursoId).'/'.$this->ProCurso->getCursoPath($cursoId).'/'.$this->viewVars['actualUser']['SEG_USUARIO'].'-'.$this->viewVars['actualUser']['NOMBRE'].'_'.$this->viewVars['actualUser']['APELLIDO_1'].'/';

            if($this->SolSolicitud->existeSolicitud($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId) == 0){
                $this->SolSolicitud->crearSolicitud($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId);
                $this->FileSystem->addFolder($foldername);
            }
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
                        $this->SolTextoCorto->insertarTextoCorto($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break; 
                        
                    case 1: // Texto medio 
                        $this->SolTextoMedio->insertarTextoMediano($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 2: // Texto largo
                        $this->SolTextoLargo->insertarTextoLargo($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 3: // Número
                        $this->SolNumero->insertarNumero($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 4: // Fecha
                        $this->SolFecha->insertarFecha($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 5: // Select
                        $this->SolTextoCorto->insertarTextoCorto($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 6: // Email
                        $this->SolTextoCorto->insertarTextoCorto($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 7: // Teléfono
                        $this->SolTextoCorto->insertarTextoCorto($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $respuestas[$iterador]);
                    break;

                    case 8: // Archivo
                        $fileName = $respuestas[$iterador]['name'];
                        $fileTmpName = $respuestas[$iterador]['tmp_name'];
                        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
                        $filePath = $foldername.$fileName;
                        $uploadState = $this->FileSystem->uploadFile($fileName, $fileTmpName, $filePath, $fileExt);
                        $this->SolArchivo->insertarArchivo($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $numPregunta, $filePath);
                    break;
                }
            }

            $this->Flash->success("The entire form was successfully entered");
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'studentDashboard']);
        }

        $this->loadModel('SolFormulario');
        $this->loadModel('SolOpciones');

        $pregSol = $this->SolFormulario->getPreguntasFormulario($cursoId);

        $opcionPreg = [];
        foreach($pregSol as $pregunta){
            if($pregunta['TIPO'] == 5){
                $opcionPreg[$pregunta['SOL_PREGUNTA']] = $this->SolOpciones->getOpciones($pregunta['SOL_PREGUNTA']);
            }
        }

        $this->set(compact('pregSol', $pregSol));
        $this->set(compact('opcionPreg', $opcionPreg));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sol Solicitud id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($cursoId = null)
    {
        if ($this->request->is('post')) {
            $this->loadModel('ProCurso');
            $this->loadModel('SolArchivo');
            $this->loadModel('SolFecha');
            $this->loadModel('SolNumero');
            $this->loadModel('SolTextoCorto');
            $this->loadModel('SolTextoMedio');
            $this->loadModel('SolTextoLargo');

            $solicitud = $this->request->getData();
            $preguntas = array_keys($solicitud);
            $respuestas = array_values($solicitud);

            $foldername = 'FileSystem/'.$this->ProCurso->getProgramaName($cursoId).'/'.$this->ProCurso->getCursoPath($cursoId).'/'.$this->viewVars['actualUser']['NOMBRE'].'/';

            for($iterador = 0; $iterador < sizeof($preguntas); ++$iterador){
                $numPregunta = strtok($preguntas[$iterador], "_");
                $idPregunta = strtok("_");
                $tipoPregunta = strtok("_");

                switch($tipoPregunta){
                    case 0: // Texto corto
                        $this->SolTextoCorto->actualizarTextoCorto($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $respuestas[$iterador]);
                    break; 
                        
                    case 1: // Texto medio 
                        $this->SolTextoMedio->actualizarTextoMediano($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $respuestas[$iterador]);
                    break;

                    case 2: // Texto largo
                        $this->SolTextoLargo->actualizarTextoLargo($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $respuestas[$iterador]);
                    break;

                    case 3: // Número
                        $this->SolNumero->actualizarNumero($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $respuestas[$iterador]);
                    break;

                    case 4: // Fecha
                        $this->SolFecha->actualizarFecha($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $respuestas[$iterador]);
                    break;

                    case 5: // Select
                        $this->SolTextoCorto->actualizarTextoCorto($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $respuestas[$iterador]);
                    break;

                    case 6: // Email
                        $this->SolTextoCorto->actualizarTextoCorto($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $respuestas[$iterador]);
                    break;

                    case 7: // Teléfono
                        $this->SolTextoCorto->actualizarTextoCorto($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $respuestas[$iterador]);
                    break;

                    case 8: // Archivo
                        $fileName = $respuestas[$iterador]['name'];
                        $fileTmpName = $respuestas[$iterador]['tmp_name'];
                        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
                        $filePath = $foldername.$fileName;
                        $uploadState = $this->FileSystem->uploadFile($fileName, $fileTmpName, $filePath, $fileExt);
                        $this->SolArchivo->actualizarArchivo($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId, $idPregunta, $filePath);
                    break;
                }
            }

            $this->Flash->success("The entire form was successfully edited");
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'studentDashboard']);
        }

        $this->loadModel('SolFormulario');
        $this->loadModel('SolOpciones');

        $pregSol = $this->SolFormulario->getPreguntasFormulario($cursoId);
        $respSol = $this->SolSolicitud->verSolicitud($this->viewVars['actualUser']['SEG_USUARIO'], $cursoId);

        $opcionPreg = [];
        foreach($pregSol as $pregunta){
            if($pregunta['TIPO'] == 5){
                $opcionPreg[$pregunta['SOL_PREGUNTA']] = $this->SolOpciones->getOpciones($pregunta['SOL_PREGUNTA']);
            }
        }

        $this->set(compact('pregSol', $pregSol));
        $this->set(compact('respSol', $respSol));
        $this->set(compact('opcionPreg', $opcionPreg));
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
