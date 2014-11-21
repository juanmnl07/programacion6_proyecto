<?php 

//incluimos el archivo que nos sirve como interface para abrir y cerrar la conexion con la base de datos
require_once '../app/conn/conn.php';

class Costo {
	 private $id = "";
	 private $costo = "";

	 function __construct(){

	 }

	function setCosto($id = '', $costo = ''){
		$this->id = $id;
		$this->costo = $costo;
	}

	function saveCosto(){
		return writeCost(array($this->costo));
	}

	function delCosto(){
		return removeCost($this->id);
	}

	function obtenerTodasLosCostos(){
		return getAllCosts();
	}

	function obtenerCosto($id){
		$array = getCost($id);

		$this->id = $array['id'];
		$this->costo = $array['costo'];
		
		return array("id" => $this->id, 
					 "costo" => $this->costo);
	}

	function __destruct(){

	}

}