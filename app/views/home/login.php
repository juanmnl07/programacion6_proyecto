<?php 		

	//utilizar la sesion
	require_once '../app/controllers/sesion.php';

	if(!obtenerNombreUsuario()){

	if (file_exists('../vendor/twig/twig/lib/Twig/Autoloader.php')){
		require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$templateDir = array('/var/www/proyecto_progra6/app/template');
		$loader = new Twig_Loader_Filesystem($templateDir);
		$twig = new Twig_Environment($loader);

		$template = $twig->loadTemplate('base.html');
		echo $template->render(array('content' => obtenerFormulario(), 'title' => 'Index'));

	}

	}else{
		header('Location: http://www.proyecto_progra6.com/public/admin/index');
	}

	//Generar formulario
	function obtenerFormulario() {
		return array("markup" => "<div id=\"formulario-inicio-sesion\">
											<h1 id=\"inicio-sesion\">Inicio de sesion</h1>
											<form action=\"/public/admin/index\" method=\"post\">
												<label><input type=\"text\" name=\"user-name\" placeholder=\"Nombre del usuario:\"></label>
												<label><input type=\"password\" name=\"clave\" placeholder=\"Clave:\"></label>
												<input type=\"submit\" value=\"Ingresar\">
											</form>
										  </div>");
	}
	
?>