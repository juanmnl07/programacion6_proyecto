<?php
/**
* 
*/
//requerimos del archivo para abrir sesiones
require_once "sesion.php";
//incluimos el recurso del modelo respectivo al controlador para manejar la bd

class Productos extends Controller
{
	
	public function index()
	{
		//obtener todos los datos de los paquetes
		$paquete = $this->model('paquete');
		$paquetes = $paquete->obtenerTodasLosPaquetes();
		$this->view('productos/todos', ['paquetes' => $paquetes, 'resultado' => array('estatus'=>2)]);
	}

	public function pid($pid = '')
	{
		//verificar si el usuario ha iniciado sesion
		$nombre_completo = "";
		$email = "";
		if(obtenerNombreUsuario()){
			$datos_usuario = obtenerTodosLosDatosDelUsuario();
			$nombre_completo = $datos_usuario['fullname']." ". $datos_usuario['lastname'];
			$email = $datos_usuario['email'];
		}
		$paquete = $this->model('paquete');
		$datos_paquete = $paquete->obtenerPaquete($pid);
		$costo = $paquete->getCosto($paquete->getIdCosto());

		//obtener la ruta de la imagen de la cabana
		$cabana = $this->model('cabana');
		$imagen = $cabana->getImagen($datos_paquete['id_cabana']);

		$this->view('productos/pid', ['paquete' => $datos_paquete, 'costo' => $costo, 'nombre_completo' => $nombre_completo, 'email' => $email, 'imagen' => $imagen, 'resultado' => array('estatus'=>2)]);
	}

	public function payment()
	{
		//eturn $pid;
		$this->view('productos/payment', []);
	}

	public function reservar($pid = '', $id_cliente = '')
	{
		//recibe el request para realizar una reserva
		$paquete = $this->model('paquete');
		//$info_reserva = $paquete->reservar($pid, $id_cliente);
		return $_POST;
	}

}