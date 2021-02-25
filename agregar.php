<?php 

session_start();
include('conexion.php');

if (!isset($_SESSION["id_usuario"])) {
		header("location: index1.php");
	}

$error="";

$id_libro="0";
$titulo="";
$autor="";
$cantidad="";

if (isset($_POST['btnguardar'])) 
{

	$titulo=htmlspecialchars($_POST['txttitulo']);
	$autor=htmlspecialchars($_POST['txtautor']);
	$cantidad=htmlspecialchars($_POST['txtcantidad']);

	if (strlen($titulo)>30) 
	{
		$error="Solo se permiten 30 caracteres maximo";
	}else
	{
		if ($_POST['txtid']=="0") 
		{
			$sql = "INSERT INTO `libros`(`titulo`, `autor`, `cantidad`) VALUES ('$titulo','$autor','$cantidad')";
			$query=mysqli_query($conexion, $sql);
			if ($query) 
			{
				header('Refresh:0; index1.php');
			}

		}else{
			$sql="UPDATE `libros` SET `titulo`='$titulo',`autor`='$autor',`cantidad`='$cantidad' WHERE `id_libro`='{$_POST['txtid']}'";
			$query=mysqli_query($conexion, $sql);
			if ($query) 
			{		
				header('Refresh:0; index1.php');
			}

		}
	}

}

//verificación de id para editar

if (isset($_GET['edited'])) 
{
	$sql="SELECT * FROM libros WHERE id_libro='{$_GET['id_libro']}'";
	$query=mysqli_query($conexion, $sql);
	$row=mysqli_fetch_object($query);
	$id_libro=$row->id_libro;
	$titulo=$row->titulo;
	$autor=$row->autor;
	$categoria=$row->categoria;
	$cantidad=$row->cantidad;
	
}

//verificación de id para eliminar
if (isset($_GET['deleted'])) 
{
	$sql="DELETE FROM libros WHERE id_libro='{$_GET['id_libro']}' ";
	$query=mysqli_query($conexion, $sql);
	if ($query) 
	{
		header('Refresh:0; index1.php');
	}
}

?>

<html>
<head>

	<style type="text/css">

			*{
				margin: 0px;
				padding: 0px;
			}
		
			form{
				background: #E3F6CE;
				width: 380px;
				border: 3px solid #31B404;
				margin: 100px auto;
				padding: 40px 20px; 
				box-sizing: border-box;
			}
			body{
				background: url(fondo3.jpg);
				
				background-size: 100vw 100vh;
				background-attachment: fixed;
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

			nav.menu2{
				width: 890px;
				height: 50px;
		        margin: 0;
		        padding: 0;

		    }
		     nav.menu2 li{
		        display: block;
		        float: left;
		        padding: 0 10px;

		    }
			
	</style>

</head>

<body>

<section>

	<nav class="menu2">
		<menu>


			<?php
				//verifica si el usuario tiene acceso administrativo para poder agregar usuarios
				if($_SESSION['tipo_usuario']==1) { ?>

          		<li><a href="agregarusuarios.php">Registrar Usuario</a><br /><br /></li>
      
          	<?php } ?>
          <li><a href="agregar.php">Agregar Libro</a><br /><br /></li>
          <li><a href="ubicacion.php">Ubicacion</a> </li>
          <li><a href="salir.php">Cerrar Sesi&oacute;n</a><br /><br /></li>
		</menu>
		
	</nav>


	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

	<h1>Nuevo Libro </h1>
		<table>

		<tr>
			<td colspan="2"><span style="color:red;"> <?php echo $error; ?> </span> </td>
		</tr>

			<tr>
				<br /><td>Titulo</td>

				<td> <input type="text" name="txttitulo" value="<?php echo $titulo; ?>" required pattern="[A-Za-z0-9 \.]{1,30}"> <input type="hidden" name="txtid" value="<?php echo $id_libro; ?>" /> </td>
			</tr>
			<tr>
				<td>Autor</td>
				<td> <input type="text" name="txtautor" value="<?php echo $autor; ?>" required pattern="[A-Za-z0-9 \.]{1,30}"> </td>
			</tr>
			<tr>
				<td>Cantidad</td>
				<td> <input type="text" name="txtcantidad" value="<?php echo $cantidad; ?>" required pattern="[0-9]{1,15}"> </td>
			</tr>
			<tr>
				<td></td>
				<td> <input type="submit" value="Guardar" name="btnguardar"></td>
			</tr>
		</table>
	</form>
</section>
</body>
</html>