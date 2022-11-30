<?php

    header("Content-Type: application/json");
    include '../scripts/php/conexionDB/Singleton2.php';
    
    $metodo = $_SERVER['REQUEST_METHOD'];
    
    $respuesta = array();
    
    if(isset($_POST['nombre']) & isset($_POST['contraseña'])){
        $nombre= $_POST['nombre'];
        $contraseña = $_POST['contraseña'];

        Singleton2::obtenerConexion();
        $res=Singleton2::iniciarSesion($nombre,$contraseña);
        
        $respuesta['exito'] = true;
        $respuesta['respuesta'] = $res;

        echo json_encode($respuesta,true);
    }else{
        $respuesta['exito'] = false;
        $respuesta['respuesta'] = "Credenciales 'nombre de usuario' y/o 'contraseña' no proporcionadas";
        echo json_encode($respuesta, true);
    }

?>