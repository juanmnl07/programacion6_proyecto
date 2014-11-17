<?php
/**
* 
*/
class Admin extends Controller
{


	public function index()
	{
		$user = $this->model('user');		
		$resultado = array();

		//si el usuario lleno el formulario de registro
		if(isset($_POST['full-name'])) {
			$user->setUser($_POST['full-name'], $_POST['last-name'], $_POST['birthday'], $_POST['correo-electronico'], $_POST['user-name'], $_POST['clave']);
			$resultado = $user->saveUser();
			$this->view('admin/index', ['resultado' => $resultado]);
		}

		//si el usuario ha iniciado sesion
		if(isset($_POST['user-name'])) {
			$user->openSession($_POST['user-name']);
			if($user->getFullName() != ""){
				//si el usuario es administrador, se debe de extrarer toda la informacion de las cabanas
				$cabana = $this->model('cabana');
				$cabanas = $cabana->obtenerTodasLasCabanas();

				//obtener todos los registros de los paquetes
				$paquete = $this->model('paquete');
				$paquetes = $paquete->obtenerTodasLosPaquetes();

				$this->view('admin/index', ['session' => array(
					"nombre_completo" => $user->getFullName(), 
					"apellido" => $user->getApellido(),
					"fecha_nacimiento" => $user->getFechaNacimiento(), 
					"correo_electronico" => $user->getCorreoElectronico()), 
					"registro_cabanas" => $cabanas,
					"registro_paquetes" => $paquetes]);
			}else{
				$this->view('admin/index', ['resultado' => array("mensaje" => "No existen registros asociados a esta cuenta, por favor verifica, seras redireccionado al formulario de inicio de sesion.")]);
			}
		}
	}

	public function logout()
	{
		//cerrar la sesion del usuario
		//debemos desechar la instancia usuario para liberar espacio
		//pendiete
		$user = $this->model('user');
		//obtememos el nombre del usuario pormedio de la sesion
		$CloseSession = $user->closeSession('juanmnl07');
		$this->view('admin/logout', ['closeSession' => $CloseSession]);

	}

	public function agregar_cabana()
	{
		$cabana = $this->model('cabana');
		$cabana->setCabana($_POST['cod'],$_POST['cap_adultos'],$_POST['cap_ninos'],$_POST['tam'],$_POST['aire_acond'],$_POST['calef'],$_POST['desc']);
		print_r($cabana->saveCabana());
	}

	public function agregar_paquete()
	{
		$paquete = $this->model('paquete');
		$paquete->setPaquete($_POST['codigo_cabana'], $_POST['fecha_ing'],$_POST['fecha_sal'],$_POST['est']);
		print_r($paquete->savePaquete());
	}

}