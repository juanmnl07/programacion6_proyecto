<?php

//agregamos el archivo de configuracion para realizar la conexion con la bd

require_once '../app/configuration/database.php';


function openConnection(){
	$array_conn = getConnConfiguration();
	$conn=mysqli_connect($array_conn['host'],$array_conn['username'],$array_conn['password'],$array_conn['databasename']);

	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	return $conn;

}

function closeConnection($conn){
	mysqli_close($conn);
}

function writeUser($valores = array()){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	$insert_query = "INSERT INTO usuarios (nombre_completo,apellidos,fecha_nacimiento,correo_electronico,nombre_usuario,clave,rol) VALUES ('" . $valores[0] . "','" . $valores[1] . "'," . $valores[2] . ",'" . $valores[3] . "','" . $valores[4] . "','" . $valores[5] . "',1)";

	if (!mysqli_query($conn,$insert_query)) {
  		return array(
  				'estatus'=>0,
  				'mensaje'=>mysqli_error($conn)
  			);
  		exit();
	}

	//abrir la sesion
	$last_row_query = "SELECT id FROM usuarios ORDER BY id DESC LIMIT 1";
	$last_row = mysqli_query($conn,$last_row_query);
	$user_id = 0;

	
	while($row = mysqli_fetch_array($last_row)) {
	  $user_id = $row['id'];
	}


	createUserSession($user_id);

	return array(
  				'estatus'=>1,
  				'mensaje'=>'El registro del usuario: ' .$valores[0].', se ha agregado satisfactoriamente a la base de datos'
  			);

	//cerramos la conexion
	closeConnection($conn);
}

function createUserSession($id_usuario){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	$insert_query = "INSERT INTO sesion (sesion,fecha,id_usuario) VALUES ('1'," . time() . "," . $id_usuario . ")";

	if (!mysqli_query($conn,$insert_query)) {
  		exit();
	}

	//cerramos la conexion
	closeConnection($conn);

}

function dbCloseSession($user_name){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	//debemos extraer el nombre del usuario pormedio del id
	$getUsernameQuery = "SELECT id FROM usuarios WHERE nombre_usuario = '$user_name'";
	$last_row = mysqli_query($conn,$getUsernameQuery);
	$user_id = 0;

	
	while($row = mysqli_fetch_array($last_row)) {
	  $user_id = $row['id'];
	}

	$insert_query = "INSERT INTO sesion (sesion,fecha,id_usuario) VALUES (0," . time() . ",". $user_id . ")";

	if (!mysqli_query($conn,$insert_query)) {
		print_r(mysqli_error($conn));
  		exit();
	}


	//cerramos la conexion
	closeConnection($conn);

	return "la sesion se ha cerrado satisfactoriamente";

}

function dbOpenSession($user_name){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	//variables para almacenar informacion temporal
	$user_id = 0;
	$fecha_ultima_sesion = 0;
	$nombre_completo = "";
	$apellido = "";
	$fecha_nacimiento = "";
	$nombre_usuario = "";
	$correo_electronico = "";
	$clave = "";
	$estatus = 0;


	//buscamos el id del usuario teniendo a disposicion el nombre del usuario
	$nombre_usuario = "SELECT id FROM usuarios WHERE nombre_usuario = '".$user_name."'";
	$row = mysqli_query($conn,$nombre_usuario);


	//tomamos una variable para almacenar el id del usuario
	//primero verificamos si el usuario esta registrado
	if($row->num_rows != 0){
		$estatus = 1;

		while($current_row = mysqli_fetch_array($row)) {
		  $user_id = $current_row['id'];
		}


		//por medio del id del usuario obtenemos la fecha de la sesion del usuario

		$last_row_query_fecha_sesion = "SELECT fecha FROM sesion WHERE id_usuario = $user_id ORDER BY id_usuario DESC LIMIT 1";
		$last_row = mysqli_query($conn,$last_row_query_fecha_sesion);
		
		while($current_row = mysqli_fetch_array($last_row)) {
		  $fecha_ultima_sesion = $current_row['fecha'];
		}

		//similar al paso anterior, obtenemos los datos personales del usuario para mostrarlo en su pagina proncipal

		$nombre_completo_usuario_row = "SELECT nombre_completo, apellidos, fecha_nacimiento, correo_electronico, nombre_usuario, clave FROM usuarios WHERE id = $user_id";
		$last_row = mysqli_query($conn,$nombre_completo_usuario_row);

		while($current_row = mysqli_fetch_array($last_row)) {
		  $nombre_completo = $current_row['nombre_completo'];
		  $apellido = $current_row['apellidos'];
		  $fecha_nacimiento = $current_row['fecha_nacimiento'];
		  $nombre_usuario = $current_row['nombre_usuario'];
		  $correo_electronico = $current_row['correo_electronico'];
		  $clave = $current_row['clave'];
		}

		//creamos una sesion nueva

		$insert_query = "INSERT INTO sesion (sesion,fecha,id_usuario) VALUES ('1'," . time() . "," . $user_id . ")";

		if (!mysqli_query($conn,$insert_query)) {
	  		exit();
		}

		//retornamos los datos del usuario y la ultima fecha y hora en que inicio sesion
		return array(
			'estatus' => $estatus,
			'nombre_completo' => $nombre_completo,
			'apellido' => $apellido,
			'fecha_nacimiento' => $fecha_nacimiento,
		    'nombre_usuario' => $nombre_usuario,
		  	'correo_electronico' => $correo_electronico,
		  	'clave' => $clave,
			'fecha' => $fecha_ultima_sesion
		);


	} else {

		return array(
			'estatus' => "",
			'nombre_completo' => "",
			'apellido' => "",
			'fecha_nacimiento' => "",
		    'nombre_usuario' => "",
		  	'correo_electronico' => "",
		  	'clave' => "",
			'fecha' => ""
		);

	}
	//cerramos la conexion
	closeConnection($conn);

}

function writeCabana($valores = array()){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	$insert_query = "INSERT INTO cabana (id,capacidad_adulotos,capacidad_ninos,tamano,aire_acondicionado,calefaccion,descripcion) VALUES ('" . $valores[0] . "'," . $valores[1] . "," . $valores[2] . ",'" . $valores[3] . "','" . $valores[4] . "','" . $valores[5] . "','" . $valores[6]."')";

	$insert_query_arvhivo = "INSERT INTO archivos (nombre_archivo) VALUES ('" . $valores[7]."')";

	if (!mysqli_query($conn,$insert_query)) {
  		return array(
  				'estatus'=>0,
  				'mensaje'=>mysqli_error($conn)
  			);
  		exit();
	}

	if (!mysqli_query($conn,$insert_query_arvhivo)) {
  		return array(
  				'estatus'=>0,
  				'mensaje'=>mysqli_error($conn)
  			);
  		exit();
	}

	//cerramos la conexion
	closeConnection($conn);

	return '{"cod" : "'.$valores[0].'", "mensaje" : "se ha agregado la cabana satisfactoriamente"}';
}

function removeCabana($cod){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	$insert_query = "DELETE FROM cabana WHERE id = '$cod'";

	if (!mysqli_query($conn,$insert_query)) {
  		return array(
  				'estatus'=>0,
  				'mensaje'=>mysqli_error($conn)
  			);
  		exit();
	}

	//cerramos la conexion
	closeConnection($conn);

	return "se ha borrado la cabana satisfactoriamente";
}

function getAllCabanas(){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	$query = "SELECT id, capacidad_adulotos, capacidad_ninos, tamano, aire_acondicionado, calefaccion, descripcion FROM cabana";
		$rows = mysqli_query($conn,$query);
		$row = 0;
		$array = array();

		while($current_row = mysqli_fetch_array($rows)) {
		  $array[$row] = array(
		  	'id' => $current_row['id'],
		  	'capacidad_adulotos' => $current_row['capacidad_adulotos'],
		  	'capacidad_ninos' => $current_row['capacidad_ninos'],
		  	'tamano' => $current_row['tamano'],
		  	'aire_acondicionado' => $current_row['aire_acondicionado'],
		  	'calefaccion' => $current_row['calefaccion'],
		  	'descripcion' => $current_row['descripcion']
		  );
		  $row = $row + 1;
		}

	//cerramos la conexion
	closeConnection($conn);

		return $array;
}

function writePackage($valores = array()){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	$insert_query = "INSERT INTO paquete_reserva (cod_cabana,fecha_ingreso,fecha_salida,estado,id_costo) VALUES ('" . $valores[1] . "'," . $valores[3] . ",'" . $valores[4] . "','" . $valores[5] ."'," . $valores[6] .")";

	if (!mysqli_query($conn,$insert_query)) {
  		return array(
  				'estatus'=>0,
  				'mensaje'=>mysqli_error($conn)
  			);
  		exit();
	}

	//cerramos la conexion
	closeConnection($conn);

	return '{"cod" : "1", "mensaje" : "se ha agregado el paquete satisfactoriamente"}';
}

function removePackage($id){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	$insert_query = "DELETE FROM paquete_reserva WHERE id_paquete_reserva = $id";

	if (!mysqli_query($conn,$insert_query)) {
  		return array(
  				'estatus'=>0,
  				'mensaje'=>mysqli_error($conn)
  			);
  		exit();
	}

	//cerramos la conexion
	closeConnection($conn);

	return "se ha borrado la cabana satisfactoriamente";
}

function getAllPackages(){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	$query = "SELECT id_paquete_reserva,id_usuario_cliente,fecha_ingreso,fecha_salida,estado,cod_cabana FROM paquete_reserva";
		$rows = mysqli_query($conn,$query);
		$row = 0;
		$array[0] = array(
			  	'id' => "",
			  	'id_usuario_cliente' => "",
			  	'fecha_ingreso' => "",
			  	'fecha_salida' => "",
			  	'estado' => "",
			  	'cod_cabana' => "",
			  );

			while($current_row = mysqli_fetch_array($rows)) {
			  $array[$row] = array(
			  	'id' => $current_row['id_paquete_reserva'],
			  	'id_usuario_cliente' => $current_row['id_usuario_cliente'],
			  	'fecha_ingreso' => $current_row['fecha_ingreso'],
			  	'fecha_salida' => $current_row['fecha_salida'],
			  	'estado' => $current_row['estado'],
			  	'cod_cabana' => $current_row['cod_cabana'],
			  );
			  $row = $row + 1;
			}
			//cerramos la conexion
			closeConnection($conn);
			return $array;
}

function getPackage($id){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	$query = "SELECT id_paquete_reserva,id_usuario_cliente,fecha_ingreso,fecha_salida,estado,cod_cabana,id_costo  FROM paquete_reserva WHERE id_paquete_reserva = $id";
		$rows = mysqli_query($conn,$query);
		$row = 0;
		$array = array(
			  	'id' => "",
			  	'id_usuario_cliente' => "",
			  	'fecha_ingreso' => "",
			  	'fecha_salida' => "",
			  	'estado' => "",
			  	'cod_cabana' => "",
			  	'id_costo' => "",
			  );

			while($current_row = mysqli_fetch_array($rows)) {
			  $array = array(
			  	'id' => $current_row['id_paquete_reserva'],
			  	'id_usuario_cliente' => $current_row['id_usuario_cliente'],
			  	'fecha_ingreso' => $current_row['fecha_ingreso'],
			  	'fecha_salida' => $current_row['fecha_salida'],
			  	'estado' => $current_row['estado'],
			  	'cod_cabana' => $current_row['cod_cabana'],
			  	'id_costo' => $current_row['id_costo'],
			  );
			}
			//cerramos la conexion
			closeConnection($conn);
			return $array;
}


//obtener un costo determinado
function getCost($id){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();
	$query = "SELECT id, costo FROM costo WHERE id = $id";
		$rows = mysqli_query($conn,$query);
		$row = 0;
		$array = array(
			  	'id' => "",
			  	'costo' => ""
			  );
			while($current_row = mysqli_fetch_array($rows)) {
			  $array = array(
			  	'id' => $current_row['id'],
			  	'costo' => $current_row['costo'],
			  );
			}
			//cerramos la conexion
			closeConnection($conn);
			return $array;
}

//guardar el costo
function writeCost($costo){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	$insert_query = "INSERT INTO costo (costo) VALUES (" . $costo . ")";

	if (!mysqli_query($conn,$insert_query)) {
  		return array(
  				'estatus'=>0,
  				'mensaje'=>mysqli_error($conn)
  			);
  		exit();
	}

	//cerramos la conexion
	closeConnection($conn);

	return '{"cod" : "1", "mensaje" : "se ha agregado el paquete satisfactoriamente"}';
}


//obtener todos los costos
function getAllCosts(){
	//abrimos la conexion con la bd para escribir
	$conn = openConnection();

	$query = "SELECT id,costo FROM costo";
		$rows = mysqli_query($conn,$query);
		$row = 0;
		$array[0] = array(
			  	'id' => "",
			  	'costo' => "",
			  );

			while($current_row = mysqli_fetch_array($rows)) {
			  $array[$row] = array(
			  	'id' => $current_row['id'],
			  	'costo' => $current_row['costo'],
			  );
			  $row = $row + 1;
			}
			//cerramos la conexion
			closeConnection($conn);
			return $array;
}


