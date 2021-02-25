<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "challenge";

try {
	$conexion=mysqli_connect($host,$user, $password,$database);
	if(!$conexion){
		$e=mysqli_error();
		trigger_error(htmlentities($e['no se pudo conectar'],ENT_QUOTES),E_USER_ERROR);
	}
	
	//$conexion = mysqli_connect($host, $user, $password, $database);
	//echo "Conectado" ;
	//echo "";
} catch (Exception $e) {
	echo "Error";
	
}

?>