<?php
/**
* 
*/

//incluimos el recurso del modelo respectivo al controlador para manejar la bd

class Productos extends Controller
{
	
	public function index()
	{
		$this->view('productos/todos', []);
	}

	public function pid($pid = '')
	{
		//eturn $pid;
		$paquete = $this->model('paquete');
		$datos_paquete = $paquete->obtenerPaquete($pid);
		$costo = $paquete->getCosto($paquete->getIdCosto());
		$this->view('productos/pid', ['paquete' => $datos_paquete, 'costo' => $costo]);
	}

}