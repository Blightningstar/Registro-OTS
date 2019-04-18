<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * SegUsuario Controller
 *
 * @property \App\Model\Table\SegUsuarioTable $SegUsuario
 *
 * @method \App\Model\Entity\SegUsuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SegUsuarioController extends AppController
{


    /**
     * Función encargada de llamar al modelo de usuario e invocar a la función encargada de cambiar contraseña
     * @author Esteban Rojas
     */
    public function modificarContraseña($id,$contraseña)
    {
        $this->SegUsuario->modificarContraseña($id,$contraseña);
    }


    /**
     * Función encargada de manejar los datos entre la controladora y la vista para el cambio de contraseña
     *  @author Esteban Rojas
     */

    public function PasswordChange($id = null)
    {
        //Se asegura de que el usuario solo pueda modificar su propio perfil
        $id = $this->obtenerUsuarioActual();
        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);


        //Ejecuta el codigo solo si el usuario presiona aceptar
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $data = $this->request->getData(); //Captura los datos del formulario

            $contraseñaAnterior = $segUsuario["CONTRASEÑA"];



            if(hash('sha256',$data["anterior"]) != strtolower($contraseñaAnterior))
            {
                $this->Flash->error(__('Error: La contraseña ingresada no coincide con su contraseña actual.'));
            }
            else
            {
                if($data["nueva"] != $data["confirmacion"])
                {
                    $this->Flash->error(__('Error: La nueva contraseña y la contraseña de confirmación son diferentes'));
                }
                else
                {
                    $this->modificarContraseña($id,hash('sha256',$data["nueva"]));

                    $this->Flash->success(__('Su contraseña ha sido modificada correctamente.'));

                    return $this->redirect(['action' => 'profile-view']);
                }

            }
            
        }

        

        $this->set(compact('segUsuario'));
    }


    /**
     * Esta función se encarga de generar una contraseña aleatoria de 20 caracteres, con mayusculas y minusculas
     * @author Esteban Rojas 
     * 
     */
    function generarContraseña()
    {
        $nuevaContraseña = "";

        for($i = 0; $i < 20; $i = $i + 1)
        {
            $numero = rand(65,90);
            
            if(rand(0,1) == 0)
                $numero = $numero + 32; //Lo hace mayuscula el 50% de las veces

            $caracter = chr($numero);
            $nuevaContraseña = $nuevaContraseña . $caracter;
        }
        return $nuevaContraseña;
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $segUsuario = $this->paginate($this->SegUsuario);

        $this->set(compact('segUsuario'));
    }

    /**
     * View method
     *
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);

        $this->set('segUsuario', $segUsuario);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $segUsuario = $this->SegUsuario->newEntity();
        if ($this->request->is('post')) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());

            
       
            $segUsuario["SEG_ROL"] += 1;
            $contraseña = $this->generarContraseña();
            $segUsuario["CONTRASEÑA"] = hash('sha256',$contraseña);

 

            if ($this->SegUsuario->save($segUsuario)) {
                $this->Flash->success(__('El usuario ha sido agregado correctamente, con la contraseña ' . $contraseña));

                //Manda el correo al usuario con la contraseña

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Error: No se puedo agregar al usuario'));
        }
        $this->set(compact('segUsuario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());
            $segUsuario["SEG_ROL"] += 1;
            if ($this->SegUsuario->save($segUsuario)) {
                $this->Flash->success(__('El usuario ha sido modificado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Error: No se puedo agregar al usuario'));
        }
        $this->set(compact('segUsuario'));
    }

    public function obtenerUsuarioActual()
    {
        return "1";
    }

        /**
     * Edit method
     *
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function profileEdit($id = null)
    {
        //Se asegura de que el usuario solo pueda modificar su propio perfil
        $id = $this->obtenerUsuarioActual();
        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $segUsuario = $this->SegUsuario->patchEntity($segUsuario, $this->request->getData());
            $segUsuario["SEG_ROL"] += 1;
            if ($this->SegUsuario->save($segUsuario)) {
                $this->Flash->success(__('Su información personal ha sido modificada correctamente.'));

                return $this->redirect(['action' => 'profile-view']);
            }
            $this->Flash->error(__('Error: No se pudo modificar su información personal'));
        }

        

        $this->set(compact('segUsuario'));
    }

     /**
     * View method
     *
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function profileView($id = null)
    {
        //Se asegura de que el usuario solo pueda modificar su propio perfil
        $id = $this->obtenerUsuarioActual();

        $segUsuario = $this->SegUsuario->get($id, [
            'contain' => []
        ]);

        $this->set('segUsuario', $segUsuario);
    }

    /**
     * Realiza un borrado lógico de un usuario según su id
     * 
     * @author Esteban Rojas
     * @return resultado indicando si el borrado fue exitoso o no.
     */
    public function deleteUser($id)
    {
        return $this->SegUsuario->deleteUser($id);
    }

    /**
     * Delete method
     *
     * @param string|null $id Seg Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $segUsuario = $this->SegUsuario->get($id);
        if ($this->deleteUser($id)) {
            $this->Flash->success(__('El usuario ha sido eliminado.'));
        } else {
            $this->Flash->error(__('Error: el usuario no ha sido eliminado.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
