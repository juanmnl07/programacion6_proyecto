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
	$nombre_usuario = "SELECT id FROM usuarios WHERE nombre_usuario = '$user_name'";
	$row = mysqli_query($conn,$nombre_usuario);

	//tomamos una variable para almacenar el id del usuario
	//primero verificamos si el usuario esta registrado
	if($row != ""){

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

	}
	//cerramos la conexion
	closeConnection($conn);
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


}