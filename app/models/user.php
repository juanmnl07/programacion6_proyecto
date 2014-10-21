<?php 

//incluimos el archivo que nos sirve como interface para abrir y cerrar la conexion con la base de datos
require_once '../app/conn/conn.php';

class User {
	 private $nombre = "";
	 private $apellido = "";
	 private $fecha_nacimiento = "";
	 private $correo_electronico = "";
	 private $nombre_usuario = "";
	 private $clave = "";


	function setUser($nombre = '', $apellido = '', $fecha_nacimiento = '', $correo_electronico = '', $nombre_usuario = '', $clave = ''){
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->fecha_nacimiento = $fecha_nacimiento;
		$this->correo_electronico = $correo_electronico;
		$this->nombre_usuario = $nombre_usuario;
		$this->clave = $clave;
	}

	function getNameUser(){
		return $this->nombre;
	}

	function saveUser(){
		return writeUser(array($this->nombre, $this->apellido, $this->fecha_nacimiento, $this->correo_electronico, $this->nombre_usuario, $this->clave));
	}

	function openSession($user_name){
		return openSession($user_name);
	}

}