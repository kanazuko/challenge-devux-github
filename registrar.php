<?php

include 'conexion.php';

        $usuario= "usuariosh1";
        $password= "passsh1";
        $error='';
        //para enviar la contraseña encriptada se usa el sha1
        $sha1_pass= sha1($password);
        
        $sql="insert into usuarios (usuario,password) values('$usuario','$sha1_pass')";
        
        if($conexion->query($sql)===TRUE)
            echo "<script>alert('Usuario $usuario agregado correctamente');</script>";
        else
            echo "<script>alert('Error al agregar usuario $usuario y password $sha1_pass');</script>";
?>