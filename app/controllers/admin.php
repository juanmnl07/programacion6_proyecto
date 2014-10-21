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
			$session = $user->openSession($_POST['user-name']);
			$this->view('admin/index', ['session' => $session]);
		}
	}

}