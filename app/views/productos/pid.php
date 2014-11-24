<?php 		

	use PayPal\Api\Payer;
	use PayPal\Api\Details;
	use PayPal\Api\Amount;
	use PayPal\Api\Transaction;
	use PayPal\Api\Payment;
	use PayPal\Api\RedirectUrls;

	require_once 'start.php';
	//utilizar la sesion
	require_once '../app/controllers/sesion.php';
	
	$comprador = new Payer();
	$detalles = new Details();
	$monto = new Amount();
	$transaccion = new Transaction();
	$pago = new Payment();
	$redireccionUrls = new RedirectUrls();

	//Payer
	$comprador->setPayment_method('paypal');

	//Detalles
	$detalles->setShipping('2.00')
			 ->setTax('0.00')
			 ->setSubtotal('20.00');

	//Amount
	$monto->setCurrency('GBP')
	->setTotal('22.00')
	->setDetails($detalles);

	//Transaccion
	$transaccion->setAmount($monto)
	->setDescription('Membership');

	$pago->setIntent('sale')
	->setPayer($comprador)
	->setTransactions([$transaccion]);

	//RedirectURLs

	$redireccionUrls->setReturnUrl('http://localhost/pagado.php?aprobado=false')
	->setCancelUrl('http://localhost/pagado.php?aprobado=false');

	$pago->setRedirectUrls($redireccionUrls);

	try{

		$pago->create($api);

		// Generate and store hash
		// Prepare and execute transaction storage

	}catch (PPConnectionException $e) {
		header('Location: http://localhost/error.php');
	}

	$redireccionUrl = "";

	foreach ($pago->getLinks() as $link) {
		if($link->getRel() == 'approval_url'){
			$redireccionUrl = $link->getHref();
		}
	}

	if (file_exists('../vendor/twig/twig/lib/Twig/Autoloader.php')){
		require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$templateDir = array('/var/www/proyecto_progra6/app/template');
		$loader = new Twig_Loader_Filesystem($templateDir);
		$twig = new Twig_Environment($loader);

		$template = $twig->loadTemplate('base.html');

		if(obtenerNombreUsuario()){
			echo $template->render(array('content' => obtenerContenido($data['paquete'], $data['costo'], $redireccionUrl, $data['nombre_completo'], $data['email']), 'title' => '', 'userlogged' => true));
		} else {
			echo $template->render(array('content' => obtenerContenido($data['paquete'], $data['costo'], $redireccionUrl, $data['nombre_completo'], $data['email']), 'title' => '', 'userlogged' => false));
		}

	}

	//Generar formulario
	function obtenerContenido($paquete, $costo, $redirectUrl, $nombre_completo, $email) {

		if($paquete['id'] != ''){
			//retornar el detalle del producto
			return array("markup" => '<div class="paquete" id="paquete-'.$paquete['id'].'">
											<form action="" metod="post" id="paquete-sererva">
												<label>Codigo paquete: </label><input type="text" name="coddigo-paquete" value="'.$paquete['id'].'" disabled>
												<label>Fecha ingreso: </label><span>'.$paquete['fecha_ingreso'].'</span>
												<label>Fecha salida: </label><span>'.$paquete['fecha_salida'].'</span>
												<label>Codigo cabaña: </label><span>'.$paquete['id'].'</span>
												<label>Estado: </label><span>'.$paquete['estado'].'</span>
												<label>Codigo cliente: </label><span>'.$paquete['id_usuario_cliente'].'</span>
												<label>Costo: </label><input name="costo" disabled value="'.$costo['costo'].'" type="text">
												
												<div class="datos-personales">

												<h2>Datos Personales</h2>
												<input type="text" placeholder="Nombre" name="nombre" value="'.$nombre_completo.'">
												<input type="text" placeholder="Correo electronico" name="correo" value="'.$email.'">

												</div>

												<button name="reservar">Solicitar reservacion</button><a href="'.$redirectUrl.'">Reservar con PayPal</a></div>'
				);
		} else {
			return array("markup" => 'vacio');
		}
	}
?>