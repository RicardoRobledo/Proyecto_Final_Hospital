<?php

    header("Content-Type: application/json");
    include '../scripts/php/modelo/Usuario.php';
    include '../scripts/php/conexionDB/Singleton2.php';
    
    $respuesta = array();

    if(isset($_POST['nombre']) & isset($_POST['contraseña'])){
        
        $nombre = $_POST['nombre'];
        $contraseña = $_POST['contraseña'];

        $usuario = new Usuario(null, $nombre, $contraseña);
        Singleton2::obtenerConexion();
        $res=Singleton2::consultarUsuario($usuario);

        if($res==true){
            $respuesta['exito'] = false;
            $respuesta['respuesta'] = 'Usuario existente, prueba de nuevo';
            echo json_encode($respuesta, true);
        }else{
            $res = Singleton2::registrar($usuario);
            $respuesta['exito'] = true;
            $respuesta['respuesta'] = $res;
            echo json_encode($respuesta, true);
        }

    }else{
        $respuesta['exito'] = false;
        $respuesta['respuesta'] = "Credenciales 'nombre de usuario' y/o 'contraseña' no proporcionadas";
        echo json_encode($respuesta, true);
    }

?>