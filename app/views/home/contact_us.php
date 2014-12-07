<?php 		

	require_once '../app/controllers/sesion.php';

	if (file_exists('../vendor/twig/twig/lib/Twig/Autoloader.php')){
		require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$templateDir = array('/var/www/proyecto_progra6/app/template');
		$loader = new Twig_Loader_Filesystem($templateDir);
		$twig = new Twig_Environment($loader);

		$template = $twig->loadTemplate('base.html');

		if(obtenerNombreUsuario()){
			$datosUsuario = obtenerTodosLosDatosDelUsuario();
			echo $template->render(array('content' => obtenerContenido($datosUsuario['fullname'].' '.$datosUsuario['lastname'], $datosUsuario['email']), 'title' => 'Contactanos', 'userlogged' => true, 'mensaje'=>$data['resultado']));
		}else {
			echo $template->render(array('content' => obtenerContenido("", ""), 'title' => 'Contactanos', 'userlogged' => false, 'mensaje'=>$data['resultado']));
		}

	}

	//Generar formulario
	function obtenerContenido($nombre_completo = "", $correo = "") {
		return array("markup" => "<div id=\"formulario-contacto\">
					<h1 id=\"inicio-sesion\">Contactanos</h1>
					<form action=\"#\" method=\"post\">
						<input type=\"text\" name=\"user-name\" placeholder=\"Nombre del usuario:\" value=\"".$nombre_completo."\">
						<input type=\"text\" name=\"asunto\" placeholder=\"Correo:\" value=\"".$correo."\">
						<input type=\"text\" name=\"asunto\" placeholder=\"Asunto:\">
						<textarea name=\"mensaje\" placeholder=\"Mensaje:\"></textarea>
						<input type=\"submit\" value=\"Enviar\">
					</form>
				</div>");
	}
	
?>