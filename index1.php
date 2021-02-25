<?php
include('conexion.php');

  session_start();
  

  if (!isset($_SESSION["id_usuario"])) 
  {
    header("location: index.php");
  }

?>



<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Base de Datos</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
      
      body{
        background: url(fondo3.jpg);
        background-size: 100vw 100vh;
        background-attachment: fixed;
      }
      a{
        color: #000;
        padding: 5px 5px;
      }
      a:active{
        background: #2EFE64;
      }

      nav.menu{
        margin: 0;
        padding: 0;
      }
      nav.menu li{
        display: block;
        float: left;
        padding: 0 10px;
      }

    </style>


  </head>
  <body>

    <section>
      <nav class="menu">
        <menu>
          <?php if($_SESSION['tipo_usuario']==1) { ?>

          <li><a href="agregarusuarios.php">Registrar Empleado</a><br /><br /></li>
      
          <?php } ?>
          <li><a href="agregar.php">Agregar Producto</a><br /><br /></li>
          <li><a href="ubicacion.php">Ubicacion</a> </li>
          <li><a href="salir.php">Cerrar Sesi&oacute;n</a><br /><br /></li>
        </menu>
      </nav>

      <p><br/></p>
      <div class="container">
        
        <h1>Productos</h1>

        <table class="table table-striped table-bordered table-hover" id="mydata">
          <thead>
            <tr>
              <th>ID</th>
              <th>Título</th>
              <th>Autor</th>
              <th>Categoría</th>
              <th>Fecha de publicación</th>
              <th>Disponibles</th>
            </tr>
          </thead>
          <tbody>

          <?php
            $sql="SELECT * FROM libros";

            $query=mysqli_query($conexion, $sql);

              if (mysqli_num_rows($query)>0)
              {

                while ($row=mysqli_fetch_object($query))
              {
        
                ?>
              <tr <?php if($row->cantidad==0) {echo 'style="background-color:#FF0000"';}?>>
                <td> <?php echo $row->id_libro; ?></td>
                <td> <?php echo $row->titulo; ?></td>
                <td> <?php echo $row->autor; ?></td>
                <td> <?php echo $row->categoria; ?></td>
                <td> <?php echo $row->fecha_pub; ?></td>
                <td> <?php if($row->cantidad==0) {echo 'LIBRO NO DISPONIBLE';}else{echo $row->cantidad;} ?></td>
                <td>
                  <a href="agregar.php?edited=1&id_libro=<?php echo $row->id_libro; ?>">Editar</a> |
                  <a href="agregar.php?deleted=1&id_libro=<?php echo $row->id_libro; ?>">Eliminar</a>
                </td>

              </tr>
          <?php
              }
             }
          ?>
            
          </tbody>

        </table>

      </div>

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="js/jquery.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jquery.dataTables.min.js"></script>
      <script src="js/dataTables.bootstrap.min.js"></script>
      <script>
      	$('#mydata').dataTable();
      </script>
    </section>
  </body>
</html>