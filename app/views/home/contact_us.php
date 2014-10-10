<?php 		

	if (file_exists('../vendor/twig/twig/lib/Twig/Autoloader.php')){
		require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$templateDir = array('/var/www/proyecto_progra6/app/template');
		$loader = new Twig_Loader_Filesystem($templateDir);
		$twig = new Twig_Environment($loader);

		$template = $twig->loadTemplate('base.html');
		echo $template->render(array('content' => obtenerContenido(), 'title' => 'Contactanos'));

	}

	//Generar formulario
	function obtenerContenido() {
		return array("markup" => "<div id=\"formulario-contacto\">
					<h1 id=\"inicio-sesion\">Contactanos</h1>
					<form action=\"#\" method=\"post\">
						<input type=\"text\" name=\"user-name\" placeholder=\"Nombre del usuario:\">
						<input type=\"text\" name=\"asunto\" placeholder=\"Asunto:\">
						<textarea name=\"mensaje\" placeholder=\"Mensaje:\"></textarea>
						<input type=\"submit\" value=\"Enviar\">
					</form>
				</div>");
	}
	
?>