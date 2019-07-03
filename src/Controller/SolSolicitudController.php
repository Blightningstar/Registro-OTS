<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\ProProgramaController;
use Cake\Event\Event;
use Dompdf\Dompdf;
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
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(17, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

        $this->loadModel('SolFormulario');

        $pregSol = $this->SolFormulario->getPreguntasFormulario($cursoId);
        $respSol = $this->SolSolicitud->verSolicitud($usuarioId,$cursoId);

        $this->set(compact('pregSol', $pregSol));
        $this->set(compact('respSol', $respSol));
        $this->set(compact('cursoId', $cursoId));
        // Faltan  botones de aceptar, rechazar y volver.
    }

    public function uploadgrades($usuarioId = null,$cursoId = null) 
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
        debug($this->viewVars);
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(15, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

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
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(16, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

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
        return round($formTable->getPercentage($course,$student),2);
    }
    
     /**
     * Method to create a pdf file of an application
     * @author Jason Zamora Trejos
     * It is called from the method exportPDF in the DashboardController
     * @param 
     * @return
     */
    public function getPDF($idUsuario=null, $idCurso=null){
        $roles = $this->viewVars['roles'];
        if(!array_key_exists(29, $roles))
            $this->redirect(['controller' => 'MainPage', 'action' => 'index']);

        $this->Solicitud = $this->loadModel('SolSolicitud');
        $this->Solicitud = $this->loadModel('SolFormulario');
        //It creates an entity to use the validators.
        $Solicitud = $this->Solicitud->newEntity();
        //This variable is used to hold the array.
        $TMPsolicitud = [];
        //Vector with the view
        $pregSol = $this->SolFormulario->getPreguntasFormulario($idCurso);
        $respSol = $this->SolSolicitud->verSolicitud($idUsuario,$idCurso);
        
        //This variable has all the data of the course that the student's application was made
        $proCurso = TableRegistry::get('pro_Curso');
        $queryCurso = $proCurso->find()
                         ->select([])
                         ->where(['pro_Curso.PRO_CURSO' => $idCurso])
                         ->toList();                         
        $TMPcurso = [];             
        foreach ($queryCurso as $queryCurso):        
            array_push($TMPcurso, $queryCurso);
        endforeach;
        
        //Change the date so it only shows mm/dd/YY
        $TMPcurso[0]['FECHA_LIMITE'] = date("m/d/Y", strtotime($TMPcurso[0]['FECHA_LIMITE']));                  
        $TMPcurso[0]['FECHA_INICIO'] = date("m/d/Y", strtotime($TMPcurso[0]['FECHA_INICIO']));
        $TMPcurso[0]['FECHA_FINALIZACION'] = date("m/d/Y", strtotime($TMPcurso[0]['FECHA_FINALIZACION']));
        
        //This variable has all the data of the program that the student's application was made
        $proPrograma = TableRegistry::get('pro_Programa');
        $queryPrograma = $proPrograma->find()
                         ->select([])
                         ->where(['pro_Programa.PRO_PROGRAMA' => $TMPcurso[0]['PRO_PROGRAMA']])
                         ->toList();
        $TMPprograma = [];             
        foreach ($queryPrograma as $queryPrograma):        
            array_push($TMPprograma, $queryPrograma);
        endforeach;
        
        //($TMPprograma);
        //debug($TMPprograma[0]['NOMBRE']);
        //debug($respSol[1]);
        
        //This variable has all the data of the student who made the application
//        $segUsuario = TableRegistry::get('seg_Usuario');
//        $queryUsuario = $segUsuario->find()
//                         ->select([])
//                         ->where(['seg_Usuario.SEG_USUARIO' => $idUsuario])
//                         ->toList();
//        $TMPusuario = [];             
//        foreach ($TMPusuario as $TMPusuario):        
//            array_push($TMPusuario, $queryUsuario);
//        endforeach;
        
//        debug($TMPusuario);
//        debug($TMPusuario[0]['NOMBRE']);
        
        
        foreach ($pregSol as $pregunta):        
           if($pregunta['ACTIVO']):
               array_push($TMPsolicitud, $respSol[$pregunta['NUMERO_PREGUNTA']]);
           endif;
        endforeach;
        
        //We use dompdf to export the application in pdf format
        require_once 'dompdf/autoload.inc.php';
        $document = new Dompdf();
        $html =
        '
            <style>
            #element1 {float:left;margin-right:10px;} #element2 {float:right;} 
            table, td, th {
            border: 1px solid black;
            }
            body {
                border: 5px double;
                width:100%;
                height:100%;
                display:block;
                overflow:hidden;
                padding:30px 30px 30px 30px
            }
            table {
                border-collapse: collapse;
                border: none;
                width: 100%;
            }
            th {
                height: 50px;
            }
            </style>
            <center><img style="height: 50px" src="C:\xampp\htdocs\Registro-OTS\webroot\img\Logos\eng\4.png"></center>
            <title>Application Review</title>
            <h2 align="center">'.$TMPprograma[0]['NOMBRE'].'</h2>
            <h2 align="center">'.$TMPcurso[0]['SIGLA'].'</h2>
            <p>&nbsp;</p>
            <div id="element1" align="left"><strong>Course Name:'.$TMPcurso[0]['NOMBRE'].'</strong></div>
            <p>&nbsp;</p>
            <div id="element1" align="left"><strong>Last Enrollment Date:'.$TMPcurso[0]['FECHA_LIMITE'].'</strong></div>
            <div id="element1" align="left"><strong>Start date:'.$TMPcurso[0]['FECHA_INICIO'].'</strong></div>
            <div id="element1" align="left"><strong>Final date:'.$TMPcurso[0]['FECHA_FINALIZACION'].'</strong></div>
            <p>&nbsp;</p>';
                        
            $numPregunta = 1;
            foreach ($pregSol as $pregSol): 
               if($pregSol['ACTIVO']):
                  $html .=
                  '<label><b>'.$numPregunta.')'.$pregSol['DESCRIPCION_ING'].'</b></label><br>
                  <label>'.$respSol[$pregSol['NUMERO_PREGUNTA']].'</label><br>
                  <hr class= \'separator\'><br>';
                  ++$numPregunta;
               endif;
            endforeach;
            
            $document->loadHtml($html);
            //set page size and orientation
            $document->setPaper('A3', 'portrait');
            //Render the HTML as PDF
            $document->render();
            //Get output of generated pdf in Browser
            $document->stream("Application-".$TMPcurso[0]['SIGLA']."-".$respSol[1] ."-".$respSol[2]."-".$respSol[3], array("Attachment"=>1));
            //1  = Download
            //0 = Preview
            //$this->Flash->error(__('El pdf de esta solicitud no pudo ser generado. Existe un error en los campos editables.'));
            $DashboardController = new DashboardController;
            return $this->redirect(['controller' => 'Dashboard','action' => 'cursoViewDashboard',$idCurso]);
        }
}
