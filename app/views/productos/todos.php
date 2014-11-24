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

			echo $template->render(array('content' => obtenerContenido($data['paquetes']), 'title' => '', 'userlogged' => true));
		}else {
			echo $template->render(array('content' => obtenerContenido($data['paquetes']), 'title' => '', 'userlogged' => false));
		}

	}

	//Generar formulario
	function obtenerContenido($paquetes) {

		print_r($paquetes);
		return array("markup" => '<h1>Nuestros Paquetes</h1>
									<div class="cards">
									  <div class="card">
									    <div class="card-image">
									      <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/mountains.png" alt="">
									    </div>
									    <div class="card-header">
									      First Card
									    </div>
									    <div class="card-copy">
									      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, officiis sunt neque facilis culpa molestiae necessitatibus delectus veniam provident.</p>
									    </div>
									    <div class="card-stats">
									      <ul>
									        <li>98<span>Items</span></li>
									        <li>298<span>Things</span></li>
									        <li>923<span>Objects</span></li>
									      </ul>
									    </div>
									   </div>
									 </div>');
	}
?>