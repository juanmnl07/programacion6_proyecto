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

			echo $template->render(array('content' => obtenerContenido($data['paquetes']), 'title' => '', 'userlogged' => true, 'mensaje'=>$data['resultado']));
		}else {
			echo $template->render(array('content' => obtenerContenido($data['paquetes']), 'title' => '', 'userlogged' => false, 'mensaje'=>$data['resultado']));
		}

	}

	//Generar formulario
	function obtenerContenido($paquete) {

		$paquetes = "";
		for ($i=0; $i < count($paquete); $i++) { 
			$paquetes .= '<div class="card">
									    <div class="card-image">
									      <a href="/public/productos/pid/'.$paquete[$i]['id'].'"><img src="/app/archivos/files/'.$paquete[$i]['nombre_archivo'].'" alt=""></a>
									    </div>
									    <div class="card-header">
									      <a href="/public/productos/pid/'.$paquete[$i]['id'].'">'.$paquete[$i]['nombre'].'</a>
									    </div>
									    <div class="card-copy">
									      <p>'.$paquete[$i]['descripcion'].'</p>
									    </div>
									    <div class="card-stats">
									      <ul>
									        <li><a href="/public/productos/pid/'.$paquete[$i]['id'].'">Ver más</a></li>
									      </ul>
									    </div>
									   </div>';
		}

		return array("markup" => '<h1>Nuestros Paquetes</h1>
									<div class="cards">'.$paquetes.'</div>');
	}
?>