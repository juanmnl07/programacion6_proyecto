<?php 		

	if (file_exists('../vendor/twig/twig/lib/Twig/Autoloader.php')){
		require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$templateDir = array('/var/www/proyecto_progra6/app/template');
		$loader = new Twig_Loader_Filesystem($templateDir);
		$twig = new Twig_Environment($loader);

		$template = $twig->loadTemplate('base.html');
		echo $template->render(array('content' => obtenerFormulario($data['test']), 'title' => 'Index'));


	}?>

<?php
	//Generar formulario
	function obtenerFormulario($test) {
		return array("markup" => "<div id=\"formulario-inicio-sesion\">
											<h1 id=\"inicio-sesion\">Registro de cuenta</h1>
											<form action=\"#\" method=\"post\">
												<input type=\"text\" name=\"full-name\" placeholder=\"Nombre del usuario:\" required>
												<input type=\"text\" name=\"last-name\" placeholder=\"Apellido:\" required>
												<input type=\"text\" name=\"birthday\" placeholder=\"Fecha de nacimiento:\" required>
												<input type=\"text\" name=\"correo-electronico\" placeholder=\"Correo electronico:\" required>
												<input type=\"text\" name=\"user-name\" placeholder=\"Nombre del usuario:\" required>
												<input type=\"password\" name=\"clave\" placeholder=\"Clave:\" required>
												<input type=\"password\" name=\"clave-confirmation\" placeholder=\"Confirmar clave:\" required>
												<input type=\"submit\" value=\"Crear cuenta\">
												$test
											</form>
										  </div>");
	}
	
?>