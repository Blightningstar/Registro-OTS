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
