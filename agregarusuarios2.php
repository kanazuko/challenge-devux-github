<?php

	session_start();
	include('conexion.php');

	if (!isset($_SESSION["id_usuario"])) {
		header("location: index1.php");
	}
	/*if (!isset($_SESSION["nivel"])) {
		$nivel=$_SESSION["nivel"];
	}*/


	$sql="SELECT id_usuario, nivel FROM usuarios";
	$result=$conexion->query($sql);

	$bandera = false;
	$nivel=0;
	if (!empty($_POST)) 
	{
		//Codigo vulnerable
		/*
		$nombre = $_POST['nombre'];
		$usuario = $_POST['usuario'];
		$password = $_POST['password'];
		$nivel = $_POST['nivel'];	
		$sha1_pass = sha1($password);
		*/

		//CODIGO PROTEGIDO A XSS
		$nombre = htmlspecialchars($_POST['nombre']);
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);
		$nivel = htmlspecialchars($_POST['nivel']);	
		$sha1_pass = sha1($password);

		$error = '';

		$sqlUser = "SELECT id_usuario FROM usuarios WHERE nombre = '$nombre'";
		$resultUser=$conexion->query($sqlUser);
		$rows = $resultUser->num_rows;

		if ($rows > 0){
			$error = "El usuario ya existe";
		}else{
			$sqlUsuario = "INSERT INTO usuarios(nombre, password,email, nivel) VALUES('$nombre','$sha1_pass','$email','$nivel')";
			$resultUsuario = $conexion->query($sqlUsuario);

			if ($resultUsuario > 0) 
			{
				$bandera = true;
			}else{
				$error = "Error al Registrar";
			}


		}
	}
	
?>

<html>
<head>
	<title>Registro Nuevo</title>

	<script>
	
		function validarNombre()
		{
			valor = document.getElementById("nombre").value;
			if(valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
				alert('Falta Llenar Nombre');
				return false;
			}else{ return true;}
		}

		function validarUsuario()
		{
			valor = document.getElementById("usuario").value;
			if(valor == null || valor.length == 0) {
				alert('Falta Llenar Email');
				return false;
			}else{ return true;}
		}

		function validarPassword()
		{
			valor = document.getElementById("password").value;
			if(valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
				alert('Falta Llenar Password');
				return false;
			}else{ 
				valor2 = document.getElementById("con_password").value;
				if (valor == valor2) 
					{
						return true;
					}else{ alert('Las contraseñas no coinciden'); return false;}

			}
		}

		function validarTipoUsuario()
		{
			indice = document.getElementById("nivel").value;
			if(indice == null || indice==0) {
				alert('Seleccione tipo de usuario');
				return false;
			}else{ return true;}
		}

		function validar()
		{
			if (validarNombre()&& validarPassword() && validarTipoUsuario())
			{
				document.registro.submit();
			}
		}

	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="estilos.css">
</head>
<body>
	<header>
		<div class="container">
			<?php if($nivel==1) { echo'

          	<a href="agregarusuarios.php">Registrar Empleado</a>
      
       		';} ?>
	        <a href="agregar.php">Agregar Producto</a>
	        <a href="ubicacion.php">Ubicacion</a>
	        <a href="salir.php">Cerrar Sesi&oacute;n</a>
		</div>
	</header>
	<form id="registro" name="registro" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<div class="container">
			<section class="main row">
				<div class="col-md-offset 2"></div>
				<article class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
					Nombre:
				</article>
				<aside class="col-xs-12 col-sm4 col-md-3 col-lg-3">
					<input id="nombre" type="text" name="nombre" required pattern="[A-Za-z0-9]{1,303}">
				</aside>
			<div class="row">
				<article class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
					Email:
				</article>
				<aside class="col-xs-12 col-sm4 col-md-3 col-lg-3">
					<input id="email" type="text" name="email" required pattern="[A-Za-z0-9\.]+@{1,40}">
				</aside>
			</div>
			<div class="row">
				<article class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
					Password:
				</article>
				<aside class="col-xs-12 col-sm4 col-md-3 col-lg-3">
					<input id="password" type="password" name="password" required pattern="[A-Za-z0-9]{1,20}">
				</aside>
			</div>
			<div class="row">
				<article class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
					Confirmar Password:
				</article>
				<aside class="col-xs-12 col-sm4 col-md-3 col-lg-3">
					<input id="con_password" type="password" name="con_password" required pattern="[A-Za-z0-9]{1,20}">
				</aside>
			</div>
			<div class="row">
				<article class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
					Tipo Usuario:
				</article>
				<aside class="col-xs-12 col-sm4 col-md-3 col-lg-3">
					<select id="nivel" name="nivel">
						<option value="0">Seleccione tipo de usuario...</option>
							<option value="1">usuario admin</option>
							<option value="0">usuario standar</option>
					</select>
				</aside>
			</div>
			<div class="row">
				<article class="col-xs-12">
				<div><input name="registrar" type="button" value="Registrar" onClick="validar();"></div>	
				</article>
			</div>
		</div>
					<!--<h1>Nuevo Usuario</h1>
					<!-- solo que acepte caracteres que le indique con el pattern
					<br /><br />
					<label>Nombre:</label>
					<input id="nombre" type="text" name="nombre" required pattern="[A-Za-z0-9]{1,303}">
				</aside><br />

				<div>
					<label>Email:</label>
					<input id="email" type="text" name="email" required pattern="[A-Za-z0-9\.]+@{1,40}">
				</div><br />

				<div>
					<label>Password:</label>
					<input id="password" type="password" name="password" required pattern="[A-Za-z0-9]{1,20}">
				</div><br />
				<div>
					<label>Confirmar Password:</label>
					<input id="con_password" type="password" name="con_password" required pattern="[A-Za-z0-9]{1,20}">
				</div><br />

				<div>
					<label>Tipo Usuario:</label>
					<select id="nivel" name="nivel">
						<option value="0">Seleccione tipo de usuario...</option>
							<option value="1">usuario admin</option>
							<option value="0">usuario standar</option>
					</select>
				</div><br />

				<div><input name="registrar" type="button" value="Registrar" onClick="validar();"></div>-->

				</form>
			</div>
	</section>
	<?php if($bandera){ ?>
		<h1>Registro exitoso</h1>
		<a href="index1.php">Regresar</a>
		
		<?php }else{ ?>
		<br />
		<div style="font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>
	<?php } ?> 
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
