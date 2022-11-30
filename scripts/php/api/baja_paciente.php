<?php

    header("Content-Type: application/json");
    include '../scripts/php/conexionDB/Singleton.php';
    include '../scripts/php/modelo/Paciente.php';
    
    $respuesta = array();
    
    $respuesta['exito'] = false;
    
    if(isset($_GET['id_paciente'])){

        $id_paciente = $_GET['id_paciente'];
        $paciente = new Paciente($id_paciente);
        
        Singleton::obtenerConexion();
        
        if(Singleton::pacienteConsulta($paciente)){
            $res=Singleton::bajaPaciente($paciente);
            $respuesta['exito'] = true;
            $respuesta['respuesta'] = $res;
            echo json_encode($respuesta,true);
        }else{
            $respuesta['respuesta'] = "el usuario no existe";
            echo json_encode($respuesta,true);
        }

    }else{
        $respuesta['respuesta'] = "id del paciente no agregado";
        echo json_encode($respuesta, true);
    }

    
?>