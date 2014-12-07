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
	 private $id_costo = "";
	 private $nombre = "";

	 function __construct(){

	 }

	function setPaquete($id_cabana = '', $fecha_ingreso = '', $fecha_salida = '', $estado = '', $id_costo, $nombre =''){
		$this->id_cabana = $id_cabana;
		$this->fecha_ingreso = $fecha_ingreso;
		$this->fecha_salida = $fecha_salida;
		$this->estado = $estado;
		$this->id_costo = $id_costo;
		$this->nombre = $nombre;
	}

	function getNombre(){
		return $this->nombre;
	}

	function getId(){
		return $this->id;
	}

	function setCodPaquete($id){
		$this->id = $id;
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

	function getIdCosto(){
		return $this->id_costo;
	}

	function getCosto($id_costo){
		return getCost($id_costo);
	}

	function savePaquete(){
		return writePackage(array($this->id, $this->id_cabana, $this->id_usuario_cliente, $this->fecha_ingreso, $this->fecha_salida, $this->estado, $this->id_costo, $this->nombre));
	}

	function delPaquete(){
		return removePackage($this->id);
	}

	function obtenerTodasLosPaquetes(){
		return getAllPackages();
	}

	function reservar($pid, $id_cliente){
		return crearReserva($pid, $id_cliente);
	}

	function obtenenerMisReservas($id_cliente){
		$nombre_usuario = getIdUser($id_cliente);
		return getMisReservas($nombre_usuario);
	}

	function obtenerPaquete($id){
		$array = getPackage($id);

		$this->id_cabana = $array['cod_cabana'];
		$this->fecha_ingreso = $array['fecha_ingreso'];
		$this->fecha_salida = $array['fecha_salida'];
		$this->estado = $array['estado'];
		$this->id = $array['id'];
		$this->id_usuario_cliente = $array['id_usuario_cliente'];
		$this->id_costo = $array['id_costo'];
		$this->nombre = $array['nombre'];
		
		return array("id" => $this->id, 
					 "id_cabana" => $this->id_cabana,
					 "id_usuario_cliente" => $this->id_usuario_cliente,
					 "fecha_ingreso" => $this->fecha_ingreso, 
					 "fecha_salida" => $this->fecha_salida, 
					 "estado" => $this->estado, 
					 "id_costo" => $this->id_costo, 
					 "nombre" => $this->nombre);
	}

	function __destruct(){

	}

}