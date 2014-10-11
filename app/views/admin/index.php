<?php 		

	if (file_exists('../vendor/twig/twig/lib/Twig/Autoloader.php')){
		require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$templateDir = array('/var/www/proyecto_progra6/app/template');
		$loader = new Twig_Loader_Filesystem($templateDir);
		$twig = new Twig_Environment($loader);

		$template = $twig->loadTemplate('base.html');
		echo $template->render(array('content' => obtenerContenido(), 'title' => 'Admin'));

	}

	//Generar formulario
	function obtenerContenido() {
		return array("markup" => '<button type="button" class="js-menu-trigger sliding-menu-button">
								    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/menu.png" alt="Menu Icon">
								  </button>

								<nav class="js-menu sliding-menu-content">
								  <ul>
								    <li><a href="javascript:void(0)">Item 1</a></li>
								    <li><a href="javascript:void(0)">Item 2</a></li>
								    <li><a href="javascript:void(0)">Item 3</a></li>
								  </ul>
								</nav>

								<div class="js-menu-screen menu-screen"></div>');
	}
	
?>