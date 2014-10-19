<?php 

//incluimos el archivo que nos sirve como interface para abrir y cerrar la conexion con la base de datos
require_once '../app/conn/conn.php';

class User {
	 private $name = "";
	 private $apellido = "";
	 private $fecha_nacimiento = "";
	 private $correo_electronico = "";
	 private $nombre_usuario = "";
	 private $clave = "";


	function __construct($name, $apellido, $fecha_nacimiento, $correo_electronico, $nombre_usuario, $clave){
		$this->name = $name;
		$this->apellido = $apellido;
		$this->fecha_nacimiento = $fecha_nacimiento;
		$this->correo_electronico = $correo_electronico;
		$this->nombre_usuario = $nombre_usuario;
		$his->clave = $clave;
	}

	function getConnection(){

		print_r(openConnection());

	}
}