<?php 

//incluimos el archivo que nos sirve como interface para abrir y cerrar la conexion con la base de datos
require_once '../app/conn/conn.php';

class Cabana {
	 private $codigo = "";
	 private $capacidad_adultos = "";
	 private $capacidad_ninos = "";
	 private $tamano = "";
	 private $aire_acondicionado = "";
	 private $calefaccion = "";
	 private $descripcion = "";

	 function __construct(){

	 }

	function setCabana($codigo = '', $capacidad_adultos = '', $capacidad_ninos = '', $tamano = '', $aire_acondicionado = '', $calefaccion = '', $descripcion = ''){
		$this->codigo = $codigo;
		$this->capacidad_adultos = $capacidad_adultos;
		$this->capacidad_ninos = $capacidad_ninos;
		$this->tamano = $tamano;
		$this->aire_acondicionado = $aire_acondicionado;
		$this->calefaccion = $calefaccion;
		$this->descripcion = $descripcion;
	}

	function getCodigo(){
		return $this->codigo;
	}

	function setCod($cod){
		$this->codigo = $cod;
	}

	function getCapacidadAdultos(){
		return $this->capacidad_adultos;
	}

	function getCapacidadNinos(){
		return $this->capacidad_ninos;
	}

	function getTamano(){
		return $this->tamano;
	}

	function getAireAcondicionado(){
		return $this->aire_acondicionado;
	}

	function getCalefaccion(){
		return $this->calefaccion;
	}

	function getDescripcion(){
		return $this->descripcion;
	}

	function saveCabana(){
		return writeCabana(array($this->codigo, $this->capacidad_adultos, $this->capacidad_ninos, $this->tamano, $this->aire_acondicionado, $this->calefaccion, $this->descripcion));
	}

	function delCabana(){
		return removeCabana($this->codigo);
	}

	function obtenerTodasLasCabanas(){
		return getAllCabanas();
	}

	function __destruct(){

	}

}