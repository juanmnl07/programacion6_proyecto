<?php 		

	if (file_exists('../vendor/twig/twig/lib/Twig/Autoloader.php')){
		require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$templateDir = array('/var/www/proyecto_progra6/app/template');
		$loader = new Twig_Loader_Filesystem($templateDir);
		$twig = new Twig_Environment($loader);

		$template = $twig->loadTemplate('base.html');
		echo $template->render(array('content' => obtenerContenido(), 'title' => 'Acerca de Nosotros'));

	}

	//Generar formulario
	function obtenerContenido() {
		return array("markup" => "<div class=\"intro-text\">
									  <h1>Acerca de Nosotros</h1>
									  <p>Lorem ipsum dolor sit amet, consectetur consectetur adipisicing elit. Perferendis para mitis eun non ullam atque debitis, illo adipisicing elit. Perferendis para mitis eun non ullam atque debitis, illo. Amet, consectetur adipisicing.</p>
								</div>");
	}
	
?>