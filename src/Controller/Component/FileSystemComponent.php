<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class FileSystemComponent extends Component {
    /*  
        The structure of the FileSystem
        Program Folder
            Year-Month-Course Folder
                Student Folder
                    Student Files
     */

    // Load the flash component.
    public $components = ['Flash','FileSystem'];

    /**
     * addFolder
     * @author Nathan González Herrera.
     * 
     * Create a new folder with a given path.
     */
    public function addFolder($path){
        if(!file_exists($path)){    // If the file is possible
            mkdir($path, 0644, true);   // Create the folder.
        }
    }

    /**
     * deleteFile
     * @author Nathan González Herrera.
     * 
     * Delete the path owner if is a file.
     */
    public function deleteFile($path){
        if(file_exists($path)){ // If the file exist 
            if(!is_dir($path))  // And is a file, not a folder
                unlink($path);  // Delete it.
        }
    }

    /**
     * deleteFolder
     * @author Nathan González Herrera.
     * 
     * Delete a folder and all the file or subfolders in it (The function is recursive).
     */
    public function deleteFolder($path){
        $files = scandir($path);    // The folder have things in it?
        
        if($files != false){    // If it has
            foreach($files as $file){   // delete one by one.
                if(file_exists($path.$file) && !preg_match("/^\.*$/", $file)){
                    if(is_dir($path.$file)) // If one thing it has was a subfolder call a recursive funtion of it.
                        $this->FileSystem->deleteFolder($path.$file.'/');
                    else
                        unlink($path.$file);    // If is a file delete it.
                }
            }
        }

        rmdir($path);   // Delete the given folder.
    }

    /**
     * downloadFile
     * @author Nathan González Herrera.
     * 
     * If the path exist and the owner is a file show a window to download it.
     */
    public function downloadFile($path){
        if (file_exists($path)) {   // If the file exist, charge a window to download it.
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

    /**
     * uploadFile
     * @author Nathan González Herrera.
     * 
     * Upload a given file in a given path. 
     * The only files accepted was the .pdf and .doc files.
     * 
     * @return flash indicating an error or a success.
     */
    public function uploadFile($name, $tmp_name, $path, $ext){
        if(!empty($name)){  // If the file has a name
            if($ext == 'pdf' || $ext == 'doc' || $ext == 'txt'){ // if the file has a proper extension
                if(move_uploaded_file($tmp_name, $path)){   // Copy the file in the given direction.
                    $this->Flash->success(__('The file was upload succesfully'));
                    return 1;
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
        return 0;
    }
}
?>