<?php 		

	if (file_exists('../vendor/twig/twig/lib/Twig/Autoloader.php')){
		require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$templateDir = array('/var/www/proyecto_progra6/app/template');
		$loader = new Twig_Loader_Filesystem($templateDir);
		$twig = new Twig_Environment($loader);

		$template = $twig->loadTemplate('base.html');
	
		//verificamos si el usuario ingreso por medio del formulario de inicio de sesio o por medio del registro
		if(isset($data['session'])){
			echo $template->render(array('content' => obtenerContenidoUsuarioSesion($data['session']), 'title' => 'Dashboard', 'userlogged' => true));
		}else {
			echo $template->render(array('content' => obtenerContenidoUsuarioRegistro(), 'title' => 'Dashboard','mensaje'=>$data['resultado'], 'userlogged' => false));
		}

	}?>

<?php
	//Generar formulario
	function obtenerContenidoUsuarioSesion($user_info) {
		return array("markup" => "<div id=\"user-info\"><div id=\"presonal-information\"><label>Nombre completo: " .$user_info['nombre_usuario']."</label><label>Dia y hora de la ultima sesion: "."</label></div></div>");

	}

	function obtenerContenidoUsuarioRegistro() {
		return array("markup" => "test");

	}
	
	
?>