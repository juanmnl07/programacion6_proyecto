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
	
	closeConnection($conn);

}

function closeConnection($conn){
	mysqli_close($conn);
}