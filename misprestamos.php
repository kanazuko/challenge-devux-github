<?php
include('conexion.php');

  session_start();
  

  if (!isset($_SESSION["id_usuario"])) 
  {
    header("location: index.php");
  }else{
    $id_usuario=$_SESSION["id_usuario"];
  }

?>



<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Librería</title>

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

          <li><a href="agregarusuarios.php">Registrar Usuario</a><br /><br /></li>
          <li><a href="agregar.php">Agregar Libro</a><br /><br /></li>
          <?php } ?>
          <li><a href="index1.php">Libros Disponibles</a> </li>
          <li><a href="misprestamos.php">Mis Prestamos</a> </li>
          <li><a href="salir.php">Cerrar Sesi&oacute;n</a><br /><br /></li>
        </menu>
      </nav>

      <p><br/></p>
      <div class="container">
        
        <h1>Mis libros Prestados</h1>

        <table class="table table-striped table-bordered table-hover" id="mydata">
          <thead>
            <tr>
              <th>ID Libro</th>
              <th>Título</th>
              <th>Autor</th>
              <th>Nombre del solicitante</th>
              <th>En posesión</th>
            </tr>
          </thead>
          <tbody>

          <?php
            $sql="SELECT * FROM prestamo WHERE prestamo.id_usuario=$id_usuario";
            $query=mysqli_query($conexion, $sql);

              if (mysqli_num_rows($query)>0)
              {
                while($row=mysqli_fetch_object($query))
                {
                  $sql="SELECT * FROM prestamo,usuarios,libros WHERE prestamo.id_usuario=$row->id_usuario AND libros.id_libro=$row->id_libro AND prestamo.id_libro=$row->id_libro AND usuarios.id_usuario=$row->id_usuario;";
                  $query2=mysqli_query($conexion, $sql);
                  if ($row2=mysqli_fetch_object($query2))
                  {
                    $activo=$row->activo;
                    $id_prestamo=$row2->id_prestamo;
                    $id_libro=$row2->id_libro;
                    ?>
                    <tr>
                      <td> <?php echo $row2->id_libro; ?></td>
                      <td> <?php echo $row2->titulo; ?></td>
                      <td> <?php echo $row2->autor; ?></td>
                      <td> <?php echo $row2->nombre; ?></td>
                      <td> <?php if($activo!=1) {echo "libro regresado";}else echo "en posesion";?></td>
                      <?php if($activo==1){echo "
                        <td>
                        <a href='agregar.php?regreso=1&id_prestamo=$id_prestamo;&id_libro=$id_libro;'>Regresar libro</a>
                      </td>
                    </tr>
                      "; }?>
                      
                    <?php
                  }
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