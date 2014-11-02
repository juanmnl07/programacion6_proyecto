<?php
/**
* 
*/
class Admin extends Controller
{


	public function index()
	{
		$user = $this->model('user');		
		$resultado = array();

		//si el usuario lleno el formulario de registro
		if(isset($_POST['full-name'])) {
			$user->setUser($_POST['full-name'], $_POST['last-name'], $_POST['birthday'], $_POST['correo-electronico'], $_POST['user-name'], $_POST['clave']);
			$resultado = $user->saveUser();
			$this->view('admin/index', ['resultado' => $resultado]);
		}

		//si el usuario ha iniciado sesion
		if(isset($_POST['user-name'])) {
			$user->openSession($_POST['user-name']);
			if($user->getNameUser() != ""){
				$this->view('admin/index', ['session' => array("nombre_usuario" => $user->getNameUser())]);
			}else{
				$this->view('admin/index', ['resultado' => array("mensaje" => "No existen registros asociados a esta cuenta, por favor verifica")]);
			}
		}
	}

	public function logout()
	{
		//cerrar la sesion del usuario
		//debemos desechar la instancia usuario para liberar espacio
		//pendiete
		$user = $this->model('user');
		//obtememos el nombre del usuario pormedio de la sesion
		$CloseSession = $user->closeSession('juanmnl07');
		$this->view('admin/logout', ['closeSession' => $CloseSession]);

	}

}