<?php

	session_start();
	include('conexion.php');

	if (isset($_SESSION["id_usuario"])) {
		header("location: index1.php");
	}
	if (isset($_SESSION["nivel"])) {
		$nivel=$_SESSION["nivel"];
	}


	$sql="SELECT id_usuario, nivel FROM usuarios";
	$result=$conexion->query($sql);

	$bandera = false;

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
		$usuario = htmlspecialchars($_POST['usuario']);
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
			$sqlUsuario = "INSERT INTO usuarios(nombre, password,email, nivel) VALUES('$usuario','$sha1_pass','$email','$nivel')";
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

		/*function validarUsuario()
		{
			valor = document.getElementById("usuario").value;
			if(valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
				alert('Falta Llenar Usuario');
				return false;
			}else{ return true;}
		}*/

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
			if (validarNombre() && validarUsuario() && validarPassword() && validarTipoUsuario())
			{
				document.registro.submit();
			}
		}

	</script>

	<style>

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
			width: 380px;
			border: 3px solid #31B404;
			margin: 30px auto;
			padding: 40px 30px; 
			box-sizing: border-box;
		}
		form h1{
			text-align: center;
			font-weight: normal;
			color: #31B404;
			font-size: 30pt;
			margin: 0;
		}
		form input{
			width: 200px;
			height: 25px;
			margin: 10px 30px;
		}

		a{
	        color: #000;
	        padding: 5px 5px;
	        font-size: 18;
	     }
	     a:active{
	        background: #2EFE64;
	     }

		nav.menu1{
			width: 890px;
			height: 50px;
        	margin: 0;
       		padding: 0;
      	}
      	nav.menu1 li{
       		display: block;
        	float: left;
        	padding: 0 10px;
      	}
	</style>

</head>
<body>

<section>
	<nav class="menu1">
		<menu>
			<?php if($_SESSION['nivel']==1) { ?>

          <li><a href="agregarusuarios.php">Registrar Empleado</a><br /><br /></li>
      
          <?php } ?>
          <li><a href="agregar.php">Agregar Producto</a><br /><br /></li>
          <li><a href="ubicacion.php">Ubicacion</a> </li>
          <li><a href="salir.php">Cerrar Sesi&oacute;n</a><br /><br /></li>
		</menu>
		
	</nav>

	<form id="registro" name="registro" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<div>

		<h1>Nuevo Usuario</h1>
		<!-- solo que acepte caracteres que le indique con el pattern -->
			<br /><br />
			<label>Nombre:</label>
			<input id="nombre" type="text" name="nombre" required pattern="[A-Za-z0-9]{1,15}">
		</div><br />

		<div>
			<label>Usuario:</label>
			<input id="usuario" type="text" name="usuario" required pattern="[A-Za-z0-9]{1,15}">
		</div><br />

		<div>
			<label>Password:</label>
			<input id="password" type="password" name="password" required pattern="[A-Za-z0-9]{1,15}">
		</div><br />

		<div>
			<label>Confirmar Password:</label>
			<input id="con_password" type="password" name="con_password" required pattern="[A-Za-z0-9]{1,15}">
		</div><br />

		<div>
			<label>Tipo Usuario:</label>
			<select id="nivel" name="nivel">
				<option value="0">Seleccione tipo de usuario...</option>
				<?php while($row = $result->fetch_assoc()){ ?>
					<option value="<?php echo $row['id_tipou']; ?>"><?php echo $row['tipo']; ?></option>
				<?php }?>
			</select>
		</div><br />

		<div><input name="registrar" type="button" value="Registrar" onClick="validar();"></div>

	</form>

	<?php if($bandera){ ?>
		<h1>Registro exitoso</h1>
		<a href="index1.php">Regresar</a>
		
		<?php }else{ ?>
		<br />
		<div style="font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>
	<?php } ?> 

</section>
</body>
</html>
