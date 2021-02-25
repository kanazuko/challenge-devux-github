<?php
include('conexion.php');

	session_start();

//verifico q ya exita la sesion y no pueda volver atras 
if (isset($_SESSION["id_usuario"]))
{
	header("location: index1.php");
}

	if (!empty($_POST)) 
	{
		
		//codigo vulnerable 
		//$usuario = $_POST['usuario'];
		//$password = $_POST['password'];
		//$sql="SELECT id_usuario, idtipou FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";

		//****************CODIGO PROTEGIDO XSS ****************************************************
		
		$usuario = htmlspecialchars($_POST['usuario']);
		$password = htmlspecialchars($_POST['password']);
		$error='';
		//para enviar la contraseña encriptada se usa el sha1
		$sha1_pass = sha1($password);
		$sql="SELECT id_usuario, nivel FROM usuarios WHERE nombre = '$usuario' AND password = '$sha1_pass'";
		


		//$stid = oci_parse($conexion, $sql);
    	//oci_execute($stid);

		//$result = $this->pdo->prepare($sql);
        $result=mysqli_query($conexion, $sql);
            //para obtener un numero de filas
        if (mysqli_num_rows($result)>0)
        {
        		$row = mysqli_fetch_assoc($result);
				$_SESSION['id_usuario'] = $row['id_usuario'];
				$_SESSION['tipo_usuario'] = $row['nivel'];

				header("location: index1.php");
		}
		else{
		$error="El nombre o contraseña son incorrectos";
		}
	}

?>

<html>
	<head>
		<title>Login</title>

		<style type="text/css">
			*{
				margin: 0px;
				padding: 0px;
			}
			body{
				background: url(fondo3.jpg);	
				background-size: 100vw 100vh;
				background-attachment: fixed;
			}
			form{
				background: #E3F6CE;
				width: 350px;
				border: 5px solid #31B404;
				margin:130px auto; 
			}
			form h1{
				text-align: center;
				color: #31B404;
				font-weight: normal;
				font-size: 40pt;
				margin: 30px 0px;
			}
			form input{
				width: 280px;
				height: 35px;
				margin: 10px 30px;
				padding: 0px 10px;
				text-align: center;
			}
			
		</style>	
	</head>

  	<body>

     	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "POST">

     	<h1>Inicia Sesion</h1>

    		<!--solo que acepte caracteres que le indique con el pattern -->
			<input type = "text" id="usuario" name = "usuario" placeholder="Usuario" required pattern="[A-Za-z0-9]{1,15}"></div>
	  		<br/>
			
			<input type = "password" id="password" name = "password" placeholder="Password" required pattern="[A-Za-z0-9]{1,15}"></div>
	  		<br/>
			
			<div><input type = "submit" name="login" value="Entrar"></div>
	  		<br/>
	  		
	  		<div style="font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>
    	</form>
  	</body>
</html>