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
			echo $template->render(array('content' => obtenerContenidoUsuarioSesion($data['session'], $data['registro_cabanas'], $data['registro_paquetes']), 'title' => 'Dashboard', 'userlogged' => true));
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
	function obtenerContenidoUsuarioSesion($user_info, $registro_cabanas, $registro_paquetes) {

		$content = "";
		$content_paquetes = "";
		$codigos_cabanas = "<select name=\"codigos-cabanas\">";

		for ($i=0; $i < count($registro_cabanas); $i++) { 
			$content .= "<tbody>
						    <tr id=\"cabana-cod-".$registro_cabanas[$i]['id']."\">
						      <td class=\"cod-cabana\">".$registro_cabanas[$i]['id']."</td>
						      <td><button id=\"modificar-cabana-cod-".$registro_cabanas[$i]['id']."\">modificar</button><button id=\"eliminar-cabana-cod-".$registro_cabanas[$i]['id']."\">Eliminar</button></td>
						    </tr>
					    </tbody>";

			$codigos_cabanas .= "<option value=\"".$registro_cabanas[$i]['id']."\">".$registro_cabanas[$i]['id']."</option>";

		}

		$codigos_cabanas .= "</select>";

		//regisros de paquetes
		if(isset($registro_paquetes[0]['id']) && $registro_paquetes[0]['id'] != ""){
			for ($i=0; $i < count($registro_paquetes); $i++) { 
				$content_paquetes .= "<tbody>
							    <tr id=\"cabana-cod-".$registro_paquetes[$i]['id']."\">
							      <td class=\"cod-cabana\">".$registro_paquetes[$i]['id']."</td>
							      <td class=\"estado-paquete\">".$registro_paquetes[$i]['estado']."</td>
							      <td><button id=\"modificar-cabana-cod-".$registro_paquetes[$i]['id']."\">modificar</button><button id=\"eliminar-cabana-cod-".$registro_paquetes[$i]['id']."\">Eliminar</button></td>
							    </tr>
						    </tbody>";
			}
		}
		
		return array("markup" => '<div class="js-menu-screen menu-screen"></div>

								<ul class="accordion-tabs-minimal">
									  <li class="tab-header-and-content">
									    <a href="#" class="tab-link is-active">Datos Personales</a>
										    <div class="tab-content">
											    <h4>Datos Personales</h4>
											    <div id="user-info"><div id="presonal-information">
											      	<ul>
											      		<li><label>Nombre completo: </label><span>' .$user_info['nombre_completo'].'</span><button>Editar</button></li>
											      		<li><label>Apellido: </label><span>' .$user_info['apellido'].'</span><button>Editar</button><li>
											      		<li><label>Fecha de nacimiento: </label><span>' .$user_info['fecha_nacimiento'].'</span><button>Editar</button><li>
											      		<li><label>Correo Electronico: </label><span>' .$user_info['correo_electronico'].'</span><button>Editar</button><li>
											      	</ul>
											    </div>
										    </div>
									    </div>
									  </li>
									  <li class="tab-header-and-content">
									    <a href="#" class="tab-link">Tus Cabañas</a>
									    <div class="tab-content">
									      <h4>Registro de cabañas</h4>
									      <table class="table-borders">
											  <thead>
											    <tr>
											      <th>Nombre o código</th>
											      <th>Opciones</th>
											    </tr>
											  </thead>'
											  	.$content.
											  '</table>

											<h4>Agregar cabaña</h4>
											<form action="" method="post" id="agregar-cabana">
												
												<input type="text" name="codigo" placeholder="Código:">
												
												<label>Capacidad</label>
												<span>Adultos</span><select id="capacidad-adultos" name="capacidad-adultos">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
												</select>
												
												<span>Niños</span><select id="capacidad-ninos" name="capacidad-ninos">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
												</select>
												
												<label>Tamaño</label>
												<span>Pequeño</span><input type="radio" name="tamano" value="p" checked>
												<span>Mediano</span><input type="radio" name="tamano" value="m">
												<span>Grande</span><input type="radio" name="tamano" value="g">

												<label>Aire acondicionado</label>
												<span>Si</span><input type="radio" name="aire-acondicionado" value="si" checked>
												<span>No</span><input type="radio" name="aire-acondicionado" value="no">

												<label>Calefacción</label>
												<span>Si</span><input type="radio" name="calefaccion" value="si" checked>
												<span>No</span><input type="radio" name="calefaccion" value="no">
												
												<textarea class="descripcion" id="descripcion-cabana" placeholder="Descripción:"></textarea>

												<!-- The fileinput-button span is used to style the file input field as button -->
											    <span class="btn btn-success fileinput-button">
											        <span>Add files...</span>
											        <!-- The file input field used as target for the file upload widget -->
											        <input id="fileupload" type="file" name="files[]" multiple>
											    </span>
											    <br>
											    
												<input type="submit" value="Agregar cabaña">
											</form>
									    </div>
									  </li>
									  <li class="tab-header-and-content">
									    <a href="#" class="tab-link">Paquetes</a>
									    <div class="tab-content">
									      <h4>Registro de paquetes</h4>
									      <table class="table-borders">
											  <thead>
											    <tr>
											      <th>Código</th>
											      <th>Estado</th>
											      <th>Opciones</th>
											    </tr>
											  </thead>'
											  	.$content_paquetes.
											  '</table>

											<h4>Agregar paquetes</h4>
											<form action="" method="post" id="agregar-paquete">
												<label>Cabaña</label>'
												.$codigos_cabanas.'
												<input type="text" name="fecha-ingreso" placeholder="Fecha ingreso:">
												<input type="text" name="fecha-salida" placeholder="Fecha salida:">
												
												<label>Estado</label>
												<select id="capacidad-adultos" name="capacidad-adultos">
													<option value="l">libre</option>
													<option value="c">Cancelado</option>
													<option value="r">Resevado</option>
													<option value="p">Pagado</option>
												</select>
												
												<input type="submit" value="Agregar paquete">
											</form>
									    </div>
									  </li>
									  <li class="tab-header-and-content">
									    <a href="#" class="tab-link">Reservas</a>
									    <div class="tab-content">
									      <p>Donec mattis mauris gravida metus laoreet non rutrum sem viverra. Aenean nibh libero, viverra vel vestibulum in, porttitor ut sapien. Phasellus tempor lorem id justo ornare tincidunt. Nulla faucibus, purus eu placerat fermentum, velit mi iaculis nunc, bibendum tincidunt ipsum justo eu mauris. Nulla facilisi. Vestibulum vel lectus ac purus tempus suscipit nec sit amet eros. Nullam fringilla, enim eu lobortis dapibus, quam magna tincidunt nibh, sit amet imperdiet dolor justo congue turpis.</p>    
									    </div>
									  </li>
									  </li>
									  <li class="tab-header-and-content">
									    <a href="#" class="tab-link">Facturacion</a>
									    <div class="tab-content">
									      <p>Donec mattis mauris gravida metus laoreet non rutrum sem viverra. Aenean nibh libero, viverra vel vestibulum in, porttitor ut sapien. Phasellus tempor lorem id justo ornare tincidunt. Nulla faucibus, purus eu placerat fermentum, velit mi iaculis nunc, bibendum tincidunt ipsum justo eu mauris. Nulla facilisi. Vestibulum vel lectus ac purus tempus suscipit nec sit amet eros. Nullam fringilla, enim eu lobortis dapibus, quam magna tincidunt nibh, sit amet imperdiet dolor justo congue turpis.</p>    
									    </div>
									  </li>
									  <li class="tab-header-and-content">
									    <a href="#" class="tab-link">Reportes</a>
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