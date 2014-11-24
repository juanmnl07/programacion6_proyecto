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
			echo $template->render(array('content' => obtenerContenido(), 'title' => 'Registro de usuarios', 'userlogged' => true));
		}else {
			echo $template->render(array('content' => obtenerContenido(), 'title' => 'Registro de usuarios', 'userlogged' => false));
		}
	}?>

<?php
	//Generar formulario
	function obtenerContenido() {
		return array("markup" => '
								<div class="grid-items-lines">
								  <a href="javascript:void(0)" class="grid-item">
								    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1_dark.png" alt="">
								    <h1>Grid Item</h1>
								    <p>Lorem ipsum dolor sit amet, elit. Rem, illum.</p>
								  </a>
								  <a href="javascript:void(0)" class="grid-item">
								    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_3_dark.png" alt="">
								    <h1>Another Item</h1>
								    <p>Lorem ipsum consectetur dolor sit amet, consectetur adipisicing elit.</p>
								  </a>
								  <a href="javascript:void(0)" class="grid-item">
								    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_2_dark.png" alt="">
								    <h1>Another Grid Item</h1>
								    <p>Lorem ipsum dolor sit amet, elit.</p>
								  </a>
								  <a href="javascript:void(0)" class="grid-item">
								    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_2_dark.png" alt="">
								    <h1>Grid Item</h1>
								    <p>Lorem ipsum dolor sit amet, elit. Rem, illum.</p>
								  </a>
								  <a href="javascript:void(0)" class="grid-item grid-item-big">
								    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_2_dark.png" alt="">
								    <h1>Wider Grid Item</h1>
								    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, illum.</p>
								  </a>
								  <a href="javascript:void(0)" class="grid-item">
								    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_3_dark.png" alt="">
								    <h1>A Grid Item</h1>
								    <p>Lorem ipsum dolor sit amet, elit. Rem, illum.</p>
								  </a>
								  <a href="javascript:void(0)" class="grid-item">
								    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1_dark.png" alt="">
								    <h1>Item</h1>
								    <p>Lorem ipsum dolor sit amet, elit. Rem, illum.</p>
								  </a>
								  <a href="javascript:void(0)" class="grid-item">
								    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_2_dark.png" alt="">
								    <h1>Last Grid Item</h1>
								    <p>Lorem ipsum dolor sit amet, elit. Rem, illum.</p>
								  </a>
								  <div class="right-cover"></div>
								  <div class="bottom-cover"></div>
								</div');
	}

	
?>