<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SolRespuesta Controller
 *
 * @property \App\Model\Table\SolRespuestaTable $SolRespuesta
 *
 * @method \App\Model\Entity\SolRespuestum[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolRespuestaController extends AppController
{
    /**
     * getShortText
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to get the short text answer.
     * @param int[] $solicitude, the id of the entity solicitude.
     * @param int $question, the id of the entity question.
     * @return string the short text answer.
     */
    public function getShortText($solicitude,$question) {
        $answerTable=$this->loadmodel('SolTextoCorto');
        return $answerTable->getAnswer($solicitude,$question);
    }

    /**
     * setShortText
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to set the short text answer.
     * @param int[] $solicitude, the id of the entity solicitude.
     * @param int $question, the id of the entity question.
     * @param string $answer the short text answer.
     */
    public function setShortText($solicitude,$question,$answer) {
        $answerTable=$this->loadmodel('SolTextoCorto');
        $answerTable->setAnswer($solicitude,$question,$answer);
    }

    /**
     * getMediumText
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to get the medium text answer.
     * @param int[] $solicitude, the id of the entity solicitude.
     * @param int $question, the id of the entity question.
     * @return string the medium text answer.
     */
    public function getMediumText($solicitude,$question) {
        $answerTable=$this->loadmodel('SolTextoMedio');
        return $answerTable->getAnswer($solicitude,$question);
    }

    /**
     * setMediumText
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to set the medium text answer.
     * @param int[] $solicitude, the id of the entity solicitude.
     * @param int $question, the id of the entity question.
     * @param string $answer, the medium text answer.
     */
    public function setMediumText($solicitude,$question,$answer) {
        $answerTable=$this->loadmodel('SolTextoMedio');
        $answerTable->setAnswer($solicitude,$question,$answer);
    }

    /**
     * getLargeText
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to get the large text answer.
     * @param int[] $solicitude, the id of the entity solicitude.
     * @param int $question, the id of the entity question.
     * @return string the large text answer.
     */
    public function getLargeText($solicitude,$question){
        $answerTable=$this->loadmodel('SolTextoLargo');
        return $answerTable->getAnswer($solicitude,$question);
    }

    /**
     * setLargeText
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to set the large text answer.
     * @param int[] $solicitude, the id of the entity solicitude.
     * @param int $question, the id of the entity question.
     * @param string $answer, the large text answer.
     */
    public function setLargeText($solicitude,$question,$answer) {
        $answerTable=$this->loadmodel('SolTextoLargo');
        $answerTable->setAnswer($solicitude,$question,$answer);
    }

    /**
     * getDate
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to get the date answer.
     * @param int[] $solicitude, the id of the entity solicitude.
     * @param int $question, the id of the entity question.
     * @return string the date answer.
     */
    public function getDate($solicitude,$question) {
        $answerTable=$this->loadmodel('SolFecha');
        return $answerTable->getAnswer($solicitude,$question);
    }

    /**
     * setDate
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to set the date answer.
     * @param int[] $solicitude, the id of the entity solicitude.
     * @param int $question, the id of the entity question.
     * @param string $answer, the date answer.
     */
    public function setDate($solicitude,$question,$answer) {
        $answerTable=$this->loadmodel('SolFecha');
        $answerTable->setAnswer($solicitude,$question,$answer);
    }
    /**
     * getNumber
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to get the number answer.
     * @param int[] $solicitude, the id of the entity solicitude.
     * @param int $question, the id of the entity question.
     * @return int the number answer.
     */
    public function getNumber($solicitude,$question) {
        $answerTable=$this->loadmodel('SolNumero');
        return $answerTable->getAnswer($solicitude,$question);
    }

    /**
     * setNumber
     * @author Daniel Marín <110100010111h@gmail.com>
     *      
     * Calls its model function to set the numeric answer.
     * @param int[] $solicitude, the id of the entity solicitude.
     * @param int $question, the id of the entity question.
     * @param int $answer the numeric answer.
     */
    public function setNumber($solicitude,$question,$answer) {
        $answerTable=$this->loadmodel('SolNumero');
        $answerTable->setAnswer($solicitude,$question,$answer);
    }
}


/**
 * @author Daniel Marín <110100010111h@gmail.com>
    CODIGO DE PRUEBA PARA EL MANEJO DE RESPUESTAS ✓
 */
// $respuesta_C = new SolRespuestaController;
// $respuesta = $respuesta_C->getLargeText(['SEG_USUARIO'=>9,'PRO_CURSO'=>1],1);
// debug($respuesta);
// $respuesta = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sodales neque nec libero congue sagittis. Nam condimentum enim nec euismod dignissim. Sed malesuada mauris est, ac imperdiet eros ultricies quis. Cras suscipit sit amet nisl ac ornare. Fusce ut porta purus. Fusce id auctor felis. Nunc elementum luctus turpis, sed auctor metus cursus laoreet. Duis urna diam, auctor id lectus sit amet, ultricies consequat dolor. Nunc quis pulvinar nisi. Pellentesque cursus tellus feugiat, dapibus mi ac, condimentum sem. Ut tempor quam sed imperdiet imperdiet. Ut in scelerisque diam, ac sollicitudin ligula. Maecenas venenatis pharetra ipsum, a lacinia enim congue eu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum non ipsum in nisl finibus sollicitudin. Ut ligula nisl, tempus sed tempus a, finibus a quam. Nullam malesuada justo in hendrerit ultricies. Vestibulum a risus venenatis, elementum velit id, elementum quam. Duis a ligula lorem. Nullam mollis ligula sit amet nulla vestibulum, et auctor leo rutrum. Praesent laoreet libero libero. Phasellus vulputate arcu quis est fringilla, sed elementum mi iaculis. Nunc ornare mi at sem mollis interdum. Suspendisse aliquam metus velit, ac convallis lectus pellentesque eu. In et ipsum luctus, interdum leo pellentesque, ultricies dui. Integer consectetur sit amet ante sed eleifend. Maecenas pretium mattis augue. Etiam accumsan aliquam sapien, eget euismod orci vulputate in. Morbi euismod lacus et consequat fermentum. Pellentesque nec sem arcu. Phasellus commodo, magna eu consectetur congue, ex dui dignissim nibh, nec sollicitudin nisi nulla a magna. Maecenas venenatis pulvinar nunc eu viverra. Quisque ultricies, velit vel sodales semper, urna dui posuere purus, sit amet convallis felis justo vitae risus. Nulla consectetur enim nec augue sagittis tempus. Aliquam sollicitudin lectus eget est tincidunt, id ultrices nunc sollicitudin. Nunc aliquet in sem in sodales. Aenean a consectetur ex. Donec interdum bibendum sollicitudin. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sit amet dolor interdum leo tincidunt lobortis. Donec dictum feugiat odio nec ultricies. Aliquam hendrerit blandit purus non rutrum. Donec a lectus in mauris hendrerit pulvinar vel venenatis est. Praesent vitae sollicitudin elit. Nunc tempus enim eu purus ullamcorper, in luctus dolor scelerisque. Curabitur at ligula a enim sollicitudin lacinia. Fusce tincidunt fringilla dolor eu aliquam. Nulla tempor risus nibh, quis aliquam arcu luctus nec. Nam viverra commodo nunc at cursus. Phasellus scelerisque elementum dui nec sodales. Fusce imperdiet risus facilisis, interdum magna eu, placerat felis. Nunc dictum justo et tortor scelerisque, sed varius lorem congue. In tellus lacus, accumsan eu varius ac, gravida at augue. Donec nec mattis nunc. Fusce ac felis ultricies, blandit eros sed, sollicitudin tortor. Quisque convallis, velit eu faucibus commodo, tellus nulla ullamcorper ligula, ut tempus est ligula eu turpis. Nullam faucibus nisl id condimentum luctus. Donec aliquam nisl dui, quis mollis ligula convallis vestibulum. Ut scelerisque urna nec lectus accumsan vulputate. Mauris hendrerit elit neque, ac bibendum lacus blandit sit amet. Duis feugiat purus in commodo hendrerit. Sed scelerisque scelerisque nunc, eu eleifend odio mollis in. Donec dictum ipsum a rhoncus iaculis. Nam congue lorem lectus, vel sodales eros tempor vel. Maecenas rutrum tempus augue vel aliquam. Nam libero dui, semper a laoreet in, consectetur auctor quam. Sed aliquet luctus purus in gravida. Nam quis porta lorem. Donec nibh justo, efficitur a aliquam in, vestibulum quis nisl. Aenean eros leo, fermentum ac ligula nec, laoreet convallis libero. Aliquam at elementum lorem. Vivamus ac mollis justo, sed imperdiet dui. Nam feugiat auctor lectus, vitae placerat diam vestibulum ut.';
// debug($respuesta);
// $respuesta_C->setLargeText(['SEG_USUARIO'=>9,'PRO_CURSO'=>1],1,$respuesta);
// $respuesta = $respuesta_C->getLargeText(['SEG_USUARIO'=>9,'PRO_CURSO'=>1],1);
// debug($respuesta);
// die();