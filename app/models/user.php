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


	 function __construct(){

	 }

	function setUser($nombre = '', $apellido = '', $fecha_nacimiento = '', $correo_electronico = '', $nombre_usuario = '', $clave = ''){
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->fecha_nacimiento = $fecha_nacimiento;
		$this->correo_electronico = $correo_electronico;
		$this->nombre_usuario = $nombre_usuario;
		$this->clave = $clave;
	}

	function getNameUser(){
		return $this->nombre_usuario;
	}

	function getFullName(){
		return $this->nombre;
	}

	function getApellido(){
		return $this->apellido;
	}

	function getFechaNacimiento(){
		return $this->fecha_nacimiento;
	}

	function getCorreoElectronico(){
		return $this->correo_electronico;
	}

	function saveUser(){
		return writeUser(array($this->nombre, $this->apellido, $this->fecha_nacimiento, $this->correo_electronico, $this->nombre_usuario, $this->clave));
	}

	function obtenterIdUsuario($user_name){
		return getIdUser($user_name);
	}

	function openSession($user_name){
		
		//vamos a utilizar los datos obtenidos por medio de la consulta a la base de datos para incializar los datos correspondientes al usuario
		//1. datos personales

		$datos_usuario = dbOpenSession($user_name);
		//setiamos los datos obtenidos.
		$this->setUser($datos_usuario['nombre_completo'],
				$datos_usuario['apellido'],
				$datos_usuario['fecha_nacimiento'],
		  		$datos_usuario['correo_electronico'],
		    	$datos_usuario['nombre_usuario'],
		  		$datos_usuario['clave']);

	}

	function getUserData($user_name){
		return getUserInfo($user_name);
	}

	function closeSession($user_name){

		$this->__destruct();

		return dbCloseSession($user_name);
	}

	function __destruct(){

	}

}