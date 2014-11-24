<?php
	session_start();

	function abrirSesion($usuario){
		$_SESSION['user_fullname'] = $usuario->getFullName();
		$_SESSION['user_lastname'] = $usuario->getApellido();
		$_SESSION['user_username'] = $usuario->getNameUser();
		$_SESSION['user_email'] = $usuario->getCorreoElectronico();
	}

	function obtenerNombreUsuario(){
		if(isset($_SESSION['user_username'])){
			return $_SESSION['user_username'];
		} else {
			return false;
		}
	}

	function obtenerTodosLosDatosDelUsuario(){
		return array(
			'fullname' => $_SESSION['user_fullname'],
			'lastname' => $_SESSION['user_lastname'],
			'email' => $_SESSION['user_email']
			);
	}

	function cerrarSesion(){
		// remove all session variables
		session_unset();

		// destroy the session
		session_destroy(); 
	}

?>