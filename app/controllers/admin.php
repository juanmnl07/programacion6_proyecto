<?php
/**
* 
*/

require_once "sesion.php";

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

				//crearSesion
				abrirSesion($user);

				//si el usuario es administrador, se debe de extrarer toda la informacion de las cabanas
				$cabana = $this->model('cabana');
				$cabanas = $cabana->obtenerTodasLasCabanas();

				//obtener todos los registros de los paquetes
				$paquete = $this->model('paquete');
				$paquetes = $paquete->obtenerTodasLosPaquetes();

				//obtener todos los precios
				$costo = $this->model('costo');
				$costos = $costo->obtenerTodasLosCostos();

				//obtener todas mis reservas
				$reservas = $paquete->obtenenerMisReservas($_POST['user-name']);

				$this->view('admin/index', ['session' => array(
					"nombre_completo" => $user->getFullName(), 
					"apellido" => $user->getApellido(),
					"fecha_nacimiento" => $user->getFechaNacimiento(), 
					"correo_electronico" => $user->getCorreoElectronico()), 
					"registro_cabanas" => $cabanas,
					"registro_paquetes" => $paquetes,
					"costos" => $costos,
					"reservas" => $reservas,
					"resultado" => array("mensaje" => "Has iniciado sesion satisfactoriamente", 
									   "estatus" => 1
					)]);
			}else{
				$this->view('admin/index', ['resultado' => array("mensaje" => "No existen registros asociados a esta cuenta, por favor verifica, seras redireccionado al formulario de inicio de sesion.", 'estatus' => 0)]);
			}
		} else {
			//si existe una sesion abierta
			if (obtenerNombreUsuario()) {

				$user->openSession(obtenerNombreUsuario());

				//verificar el tipo de usuario
				$cabana = $this->model('cabana');
				$cabanas = $cabana->obtenerTodasLasCabanas();

				//obtener todos los registros de los paquetes
				$paquete = $this->model('paquete');
				$paquetes = $paquete->obtenerTodasLosPaquetes();

				//obtener todos los precios
				$costo = $this->model('costo');
				$costos = $costo->obtenerTodasLosCostos();

				//obtener todas mis reservas
				$reservas = $paquete->obtenenerMisReservas(obtenerNombreUsuario());

				$this->view('admin/index', ['session' => array(
					"nombre_completo" => $user->getFullName(), 
					"apellido" => $user->getApellido(),
					"fecha_nacimiento" => $user->getFechaNacimiento(), 
					"correo_electronico" => $user->getCorreoElectronico()), 
					"registro_cabanas" => $cabanas,
					"registro_paquetes" => $paquetes,
					"costos" => $costos,
					"reservas" => $reservas,
					"resultado" => array("estatus" => 2)
				]);
			} else {
				//la sesion fue cerrada previamente, se redireccionara al home
				header('Location: http://www.proyecto_progra6.com/public/home/login');

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
		$CloseSession = $user->closeSession(obtenerNombreUsuario());

		cerrarSesion();

		$this->view('admin/logout', ['closeSession' => $CloseSession]);

	}

	public function agregar_cabana()
	{
		$cabana = $this->model('cabana');
		$filename = $_FILES['files']['name'][0];
		$file_tmp = $_FILES["files"]["tmp_name"][0];
		$submit = false;

		if(isset($_POST["submit"])){
			$submit = true;
		}

		$cabana->setCabana($_POST['codigo'],$_POST['capacidad-adultos'],$_POST['capacidad-ninos'],$_POST['tamano'],$_POST['aire-acondicionado'],$_POST['calefaccion'],$_POST['descripcion'], $_FILES['files']['name'][0]);
		$cabana->saveImagePath($filename, $file_tmp, $submit);
		print_r($cabana->saveCabana());
	}

	public function eliminar_cabana()
	{
		$cabana = $this->model('cabana');
		$cabana->setCod($_POST['cod']);
		print_r($cabana->delCabana());
	}

	public function agregar_paquete()
	{
		$paquete = $this->model('paquete');
		$paquete->setPaquete($_POST['codigo_cabana'], $_POST['fecha_ing'],$_POST['fecha_sal'],$_POST['est'], $_POST['id_costo'], $_POST['nombre_paquete']);
		print_r($paquete->savePaquete());
	}

	public function eliminar_paquete()
	{
		$paquete = $this->model('paquete');
		$paquete->setCodPaquete($_POST['cod']);
		print_r($paquete->delPaquete());
	}

}