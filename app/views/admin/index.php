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

	}

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
								</nav>');

	}
	//Generar formulario
	function obtenerContenidoUsuarioSesion($user_info) {
		return array("markup" => '<div id=\"user-info\"><div id=\"presonal-information\"><label>Nombre completo: ' .$user_info['nombre_usuario'].'</label><label>Dia y hora de la ultima sesion: "."</label></div></div>");
								<div class="js-menu-screen menu-screen"></div>

								<ul class="accordion-tabs-minimal">
									  <li class="tab-header-and-content">
									    <a href="#" class="tab-link is-active">Datos Personales</a>
									    <div class="tab-content">
									    <h4>Datos Personales</h4>
									      <div id=\"user-info\"><div id=\"presonal-information\"><label>Nombre completo: ' .$user_info['nombre_completo']."</label><label>Dia y hora de la ultima sesion: ".$user_info['fecha'].'</label></div></div>
									    </div>
									  </li>
									  <li class="tab-header-and-content">
									    <a href="#" class="tab-link">Tus Productos</a>
									    <div class="tab-content">
									      <p>Ut laoreet augue et neque pretium non sagittis nibh pulvinar. Etiam ornare tincidunt orci quis ultrices. Pellentesque ac sapien ac purus gravida ullamcorper. Duis rhoncus sodales lacus, vitae adipiscing tellus pharetra sed. Praesent bibendum lacus quis metus condimentum ac accumsan orci vulputate. Aenean fringilla massa vitae metus facilisis congue. Morbi placerat eros ac sapien semper pulvinar. Vestibulum facilisis, ligula a molestie venenatis, metus justo ullamcorper ipsum, congue aliquet dolor tortor eu neque. Sed imperdiet, nibh ut vestibulum tempor, nibh dui volutpat lacus, vel gravida magna justo sit amet quam. Quisque tincidunt ligula at nisl imperdiet sagittis. Morbi rutrum tempor arcu, non ultrices sem semper a. Aliquam quis sem mi.</p>
									    </div>
									  </li>
									  <li class="tab-header-and-content">
									    <a href="#" class="tab-link">Reportes</a>
									    <div class="tab-content">
									      <p>Donec mattis mauris gravida metus laoreet non rutrum sem viverra. Aenean nibh libero, viverra vel vestibulum in, porttitor ut sapien. Phasellus tempor lorem id justo ornare tincidunt. Nulla faucibus, purus eu placerat fermentum, velit mi iaculis nunc, bibendum tincidunt ipsum justo eu mauris. Nulla facilisi. Vestibulum vel lectus ac purus tempus suscipit nec sit amet eros. Nullam fringilla, enim eu lobortis dapibus, quam magna tincidunt nibh, sit amet imperdiet dolor justo congue turpis.</p>    
									    </div>
									  </li>
									  <li class="tab-header-and-content">
									    <a href="#" class="tab-link">Cuenta</a>
									    <div class="tab-content">
									      <p>Donec mattis mauris gravida metus laoreet non rutrum sem viverra. Aenean nibh libero, viverra vel vestibulum in, porttitor ut sapien. Phasellus tempor lorem id justo ornare tincidunt. Nulla faucibus, purus eu placerat fermentum, velit mi iaculis nunc, bibendum tincidunt ipsum justo eu mauris. Nulla facilisi. Vestibulum vel lectus ac purus tempus suscipit nec sit amet eros. Nullam fringilla, enim eu lobortis dapibus, quam magna tincidunt nibh, sit amet imperdiet dolor justo congue turpis.</p>    
									    </div>
									  </li>
								  </ul>');
	}

	function obtenerContenidoUsuarioRegistro() {
		return array("markup" => "test");

	}
	
	
?>