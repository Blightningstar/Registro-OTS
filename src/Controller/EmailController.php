<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * Email Controller
 *
 *
 * @method \App\Model\Entity\Email[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmailController extends AppController
{
    /**
     * sendEmail
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * Sends an email to the given user email.
     * 
     * @param string $userEmail, the user email to be contacted.
     * @param string $messageId, Selects the template message.
     * @param string[] $aditionalinfo, an array with personalised information.
     */
    public function sendEmail($userEmail,$messageId,$aditionalinfo){
        $message = $this->getMessage($messageId,$aditionalinfo);
        $subject = $this->getsubject($messageId);
        $email = new Email('default');
        if($email->to($userEmail)->subject($subject)->send($message)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * getMessage
     * @author Daniel Marín <110100010111h@gmail.com>
     *
     * Sets the message to be send via email.
     * 
     * @param int $messageId, Selects the template message.
     * @param string[]|string $aditionalinfo, personalised information for every message.
     * TODO: Establecer las plantillas de los mensajes con el cliente
     */
    private function getMessage($messageId,$aditionalinfo){
        $message = "";
        switch($messageId){
            case 'Register':
                $message = "Hello " .  $aditionalinfo['NOMBRE'] . " " . $aditionalinfo['APELLIDO_1'] . ",\n\n" .
                "Your account on the OTS system has been created.\n\n" .
                "Email: ". $aditionalinfo['CORREO'] . "\n" .
                "Username: ". $aditionalinfo['NOMBRE_USUARIO'] . "\n\n" .
                "To sign in use your email or your username and your password.";
                //. "if you received this mail by error, clic here to delete this account.\n"
                break;
            case "Accepted":
                $message = "Dear " . $aditionalinfo["NOMBRE"] . "\n\n" .
                "We would like to announce that you were accepted on the course " . $aditionalinfo["CURSO"] . "\n";
                break;
            case "Rejected":
                $message = "Dear " . $aditionalinfo["NOMBRE"] . "\n\n" .
                "Sorry, but you were rejected on the course " . $aditionalinfo["CURSO"] . "\n";
                break;
            case "Restore":
                $message = "Your restauration code is: " . $aditionalinfo;
                break;
            case 'Application':
                $message = "Hello " .  $aditionalinfo['NOMBRE'] . " " . $aditionalinfo['APELLIDO_1'] . ",\n\n" .
                "your application to course " . $aditionalinfo['CURSO'] . "was saved successfully.\n" .
                "An administrator will view your application.";
                break;
        }
        return $message;
    }

    private function getSubject($messageId){
        $subject = "";
        switch($messageId){
            case "Register":
                $subject = "OTS Registration";
                break;
            case "Accepted":
            case "Rejected":
                $subject = "OTS Course Status";
                break;
            case "Restore":
                $subject = "OTS Restauration Code";
        }
        return $subject;
    }
}
