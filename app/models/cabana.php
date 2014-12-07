<?php 

//incluimos el archivo que nos sirve como interface para abrir y cerrar la conexion con la base de datos
require_once '../app/conn/conn.php';

class Cabana {
	 private $codigo = "";
	 private $capacidad_adultos = "";
	 private $capacidad_ninos = "";
	 private $tamano = "";
	 private $aire_acondicionado = "";
	 private $calefaccion = "";
	 private $descripcion = "";
	 private $imagen = "";

	 function __construct(){

	 }

	function setCabana($codigo = '', $capacidad_adultos = '', $capacidad_ninos = '', $tamano = '', $aire_acondicionado = '', $calefaccion = '', $descripcion = '', $imagen=''){
		$this->codigo = $codigo;
		$this->capacidad_adultos = $capacidad_adultos;
		$this->capacidad_ninos = $capacidad_ninos;
		$this->tamano = $tamano;
		$this->aire_acondicionado = $aire_acondicionado;
		$this->calefaccion = $calefaccion;
		$this->descripcion = $descripcion;
		$this->imagen = $imagen;
	}

	function saveImagePath($file, $file_tmp_name, $file_size, $post_submit = true){
		$target_dir = "../app/archivos/files/";
		$target_file = $target_dir . basename($file);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($file_tmp_name);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($file_size > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($file_tmp_name, $target_file)) {
		        echo "The file ". basename( $file). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}

	function getCodigo(){
		return $this->codigo;
	}

	function setCod($cod){
		$this->codigo = $cod;
	}

	function getCapacidadAdultos(){
		return $this->capacidad_adultos;
	}

	function getImagen($id_cabana){
		return getFileName($id_cabana);
	}

	function getCapacidadNinos(){
		return $this->capacidad_ninos;
	}

	function getTamano(){
		return $this->tamano;
	}

	function getAireAcondicionado(){
		return $this->aire_acondicionado;
	}

	function getCalefaccion(){
		return $this->calefaccion;
	}

	function getDescripcion(){
		return $this->descripcion;
	}

	function saveCabana(){
		return writeCabana(array($this->codigo, $this->capacidad_adultos, $this->capacidad_ninos, $this->tamano, $this->aire_acondicionado, $this->calefaccion, $this->descripcion, $this->imagen));
	}

	function delCabana(){
		return removeCabana($this->codigo);
	}

	function obtenerTodasLasCabanas(){
		return getAllCabanas();
	}

	function obtenerCabana($id_cabana){
		return getCabana($id_cabana);
	}

	function __destruct(){

	}

}