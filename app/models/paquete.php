<?php 

//incluimos el archivo que nos sirve como interface para abrir y cerrar la conexion con la base de datos
require_once '../app/conn/conn.php';

class Paquete {
	 private $id = "";
	 private $id_cabana = "";
	 private $id_usuario_cliente = "";
	 private $fecha_ingreso = "";
	 private $fecha_salida = "";
	 private $estado = "";

	 function __construct(){

	 }

	function setPaquete($id_cabana = '', $fecha_ingreso = '', $fecha_salida = '', $estado = ''){
		$this->id_cabana = $id_cabana;
		$this->fecha_ingreso = $fecha_ingreso;
		$this->fecha_salida = $fecha_salida;
		$this->estado = $estado;
	}

	function getId(){
		return $this->id;
	}

	function getIdCabana(){
		return $this->id_cabana;
	}

	function getIdUsuarioCliente(){
		return $this->id_usuario_cliente;
	}

	function getFechaIngreso(){
		return $this->fecha_ingreso;
	}

	function getFechaSalida(){
		return $this->fecha_salida;
	}

	function getEstado(){
		return $this->estado;
	}

	function savePaquete(){
		return writePackage(array($this->id, $this->id_cabana, $this->id_usuario_cliente, $this->fecha_ingreso, $this->fecha_salida, $this->estado));
	}

	function obtenerTodasLosPaquetes(){
		return getAllPackages();
	}

	function __destruct(){

	}

}