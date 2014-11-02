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
		return $this->nombre;
	}

	function saveUser(){
		return writeUser(array($this->nombre, $this->apellido, $this->fecha_nacimiento, $this->correo_electronico, $this->nombre_usuario, $this->clave));
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

	function closeSession($user_name){

		$this->__destruct();

		return dbCloseSession($user_name);
	}

	function __destruct(){

	}

}