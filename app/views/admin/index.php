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

								<div class="js-menu-screen menu-screen"></div>

								<ul class="accordion-tabs-minimal">
									  <li class="tab-header-and-content">
									    <a href="#" class="tab-link is-active">Datos Personales</a>
									    <div class="tab-content">
									    <h4>Datos Personales</h4>
									      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt pellentesque lorem, id suscipit dolor rutrum id. Morbi facilisis porta volutpat. Fusce adipiscing, mauris quis congue tincidunt, sapien purus suscipit odio, quis dictum odio tortor in sem. Ut sit amet libero nec orci mattis fringilla. Praesent eu ipsum in sapien tincidunt molestie sed ut magna. Nam accumsan dui at orci rhoncus pharetra tincidunt elit ullamcorper. Sed ac mauris ipsum. Nullam imperdiet sapien id purus pretium id aliquam mi ullamcorper.</p>
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
	
?>