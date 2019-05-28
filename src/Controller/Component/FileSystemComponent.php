<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class FileSystemComponent extends Component {
    /*  Programa
            Año-Mes-Curso
                Estudiante  */

    public $components = ['Flash','FileSystem'];

    public function addFolder($path){
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }
    }

    public function deleteFile($path){
        if(file_exists($path)){
            if(!is_dir($path))
                unlink($path);
        }
    }

    public function deleteFolder($path){
        $files = scandir($path);
        
        if($files != false){
            foreach($files as $file){   
                if(file_exists($path.$file) && !preg_match("/^\.*$/", $file)){
                    if(is_dir($path.$file))
                        $this->FileSystem->deleteFolder($path.$file.'/');
                    else
                        unlink($path.$file);
                }
            }
        }

        rmdir($path);
    }

    public function downloadFile($path){
        if (file_exists($path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($path).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($path));
            readfile($path);
            exit;
        }
    }

    public function uploadFile($name, $tmp_name, $path, $ext){
        if(!empty($name)){

            if($ext == 'pdf' || $ext == 'doc' || $ext = 'txt'){
                
                if(move_uploaded_file($tmp_name, $path)){
                    $this->Flash->success(__('The file was upload succesfully'));
                }
                else{
                    $this->Flash->error(__('Upload file error, please try again'));
                }

            }
            else{
                $this->Flash->error(__('The extension of '.$name.' file is not allowed, please try files that have the extension .pdf or .doc'));
            }

        }
        else{
            $this->Flash->error(__('There isnt a file to upload'));
        }
    }
}
?>