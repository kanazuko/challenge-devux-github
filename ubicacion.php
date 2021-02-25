<?php
include('conexion.php');
session_start();
  if (!isset($_SESSION["id_usuario"])) 
  {
    header("location: index1.php");
  }
?>
<html>
<head>
	<title></title>

	<style type="text/css">

		*{
			margin: 0px;
			padding: 0px;
		}

		h1{
			color: #A9DFBF;
			font-size: 30pt;
			margin: 0;
		}

		body{
			background: url(fondo3.jpg);	
			background-size: 100vw 100vh;
			background-attachment: fixed;
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
		#inferior{
			color: #000;
			background: #fff;
			position:absolute; /*El div será ubicado con relación a la pantalla*/
			left:0px; /*A la derecha deje un espacio de 0px*/
			right:0px; /*A la izquierda deje un espacio de 0px*/
			bottom:0px; /*Abajo deje un espacio de 0px*/
			height:50px; /*alto del div*/
			z-index:0;
		}

	</style>

</head>



<body>

<section>
	<nav class="menu2">
		<menu>
			<?php if($_SESSION['tipo_usuario']==1) { ?>

          <li><a href="agregarusuarios.php">Registrar Empleado</a><br /><br /></li>
      
          <?php } ?>
          <li><a href="agregar.php">Agregar Producto</a><br /><br /></li>
          <li><a href="ubicacion.php">Ubicacion</a> </li>
          <li><a href="salir.php">Cerrar Sesi&oacute;n</a><br /><br /></li>
		</menu>
		
	</nav>

	<h1>Ubicacion</h1><br />

	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1867.0847499821343!2d-103.25521493269332!3d20.621946786338064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428b4861ff56475%3A0xffea04febfced782!2sTanc%C3%ADtaro+Sur+397%2C+Loma+Dorada+Delegaci%C3%B3n+D%2C+45418+Tonal%C3%A1%2C+Jal.!5e0!3m2!1ses-419!2smx!4v1495040176015" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>


</section>
</body>
</html>