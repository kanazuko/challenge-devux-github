<?php
$host = "z5zm8hebixwywy9d.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$user = "z1libq0tpk9rz8sv";
$password = "udk4zdfeyh5m50cv";
$database = "qqjlv5512bb91fm3";

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