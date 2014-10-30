<?php 		

	if (file_exists('../vendor/twig/twig/lib/Twig/Autoloader.php')){
		require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$templateDir = array('/var/www/proyecto_progra6/app/template');
		$loader = new Twig_Loader_Filesystem($templateDir);
		$twig = new Twig_Environment($loader);

		$template = $twig->loadTemplate('base.html');
		echo $template->render(array('content' => obtenerFormulario(), 'title' => 'Index'));

	}

	//Generar formulario
	function obtenerFormulario() {
		return array("markup" => "<div id=\"formulario-inicio-sesion\">
											<h1 id=\"inicio-sesion\">Registro de cuenta</h1>
											<form action=\"#\" method=\"post\">
												<input type=\"text\" name=\"full-name\" placeholder=\"Nombre del usuario:\">
												<input type=\"text\" name=\"last-name\" placeholder=\"Apellido:\">
												<input type=\"text\" name=\"birthday\" placeholder=\"Fecha de nacimiento:\">
												<input type=\"text\" name=\"correo-electronico\" placeholder=\"Correo electronico:\">
												<input type=\"text\" name=\"user-name\" placeholder=\"Nombre del usuario:\">
												<div class=\"badges formulario-registro tooltip-item\">
													<span class=\"badge\">?</span>
													  <div class=\"tooltip\">
													    <p>Utilice un nombre que sea familir y facil de recordar</p>
													  </div>
												</div>
												<input type=\"password\" name=\"clave\" placeholder=\"Clave:\">
												<div class=\"badges formulario-registro tooltip-item\">
													<span class=\"badge\">?</span>
													  <div class=\"tooltip\">
													    <p>utilizar minimo 7 caracteres y maximo 11 caracteres para definir la clave.</p>
													  </div>
												</div>
												<input type=\"password\" name=\"clave-confirmation\" placeholder=\"Confirmar clave:\">
												<input type=\"submit\" value=\"Crear cuenta\">
											</form>
										  </div>");
	}
	
?>