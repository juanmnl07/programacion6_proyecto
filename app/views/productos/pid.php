<?php 		

	if (file_exists('../vendor/twig/twig/lib/Twig/Autoloader.php')){
		require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$templateDir = array('/var/www/proyecto_progra6/app/template');
		$loader = new Twig_Loader_Filesystem($templateDir);
		$twig = new Twig_Environment($loader);

		$template = $twig->loadTemplate('base.html');
		echo $template->render(array('content' => obtenerContenido($data['paquete'], $data['costo']), 'title' => ''));

	}

	//Generar formulario
	function obtenerContenido($paquete, $costo) {

		if($paquete['id'] != ''){
			//retornar el detalle del producto
			return array("markup" => '<div class="paquete" id="paquete-"'.$paquete['id'].'>
											<label>Codigo paquete: </label><span>'.$paquete['id'].'</span>
											<label>Fecha ingreso: </label><span>'.$paquete['fecha_ingreso'].'</span>
											<label>Fecha salida: </label><span>'.$paquete['fecha_salida'].'</span>
											<label>Codigo cabaña: </label><span>'.$paquete['id'].'</span>
											<label>Estado: </label><span>'.$paquete['estado'].'</span>
											<label>Codigo cliente: </label><span>'.$paquete['id_usuario_cliente'].'</span>
											<label>Costo: </label><span>'.$costo['costo'].'</span>
									  </div>'
				);
		} else {
			return array("markup" => 'vacio');
		}
	}
?>