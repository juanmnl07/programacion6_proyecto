<?php 		

	if (file_exists('../vendor/twig/twig/lib/Twig/Autoloader.php')){
		require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$templateDir = array('/var/www/proyecto_progra6/app/template');
		$loader = new Twig_Loader_Filesystem($templateDir);
		$twig = new Twig_Environment($loader);

		$template = $twig->loadTemplate('base.html');
	
		echo $template->render(array('content' => obtenerContenido(), 'title' => 'Registro de usuarios'));

	}?>

<?php
	//Generar formulario
	function obtenerContenido() {
		return array("markup" => "test");
	}
	
?>