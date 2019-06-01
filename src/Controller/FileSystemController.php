<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FileSystem Controller
 *
 *
 * @method \App\Model\Entity\FileSystem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FileSystemController extends AppController
{
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(){
        $this->FileSystem->downloadFile('fileSystem/Prueba2.txt');

        if ($this->request->is('post')) {
            $fileName = $this->request->data['file']['name'];
            $fileTmpName = $this->request->data['file']['tmp_name'];
            $fileExt = pathinfo($this->request->data['file']['name'], PATHINFO_EXTENSION);
            $filePath = 'fileSystem/Sirve/'.$fileName;
            $uploadState = $this->FileSystem->uploadFile($fileName, $fileTmpName, $filePath, $fileExt);

            $fileName = $this->request->data['file2']['name'];
            $fileTmpName = $this->request->data['file2']['tmp_name'];
            $fileExt = pathinfo($this->request->data['file2']['name'], PATHINFO_EXTENSION);
            $filePath = 'fileSystem/Sirve/'.$fileName;
            $uploadState = $this->FileSystem->uploadFile($fileName, $fileTmpName, $filePath, $fileExt);
        }
    }
}
