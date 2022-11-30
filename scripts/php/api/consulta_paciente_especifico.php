<?php

    header("Content-Type: application/json");
    include '../scripts/php/conexionDB/Singleton.php';
    include '../scripts/php/controlador/paciente_dao.php';
    include '../scripts/php/modelo/Paciente.php';

    if(isset($_GET['parametro'])){

        $paciente = new Paciente(
            $_GET['parametro'],
            $_GET['parametro'],
            $_GET['parametro'],
            $_GET['parametro'],
            $_GET['parametro'],
            $_GET['parametro'],
            $_GET['parametro'],
            $_GET['parametro']
        );
        //var_dump($paciente);
                    
        $aDAO = new PacienteDAO();
        Singleton::obtenerConexion();
        
        $resultado = $aDAO->mostrarPacienteFiltro($paciente);
        $resultado = $resultado->fetchAll();
        
        $respuesta['exito']=true;
        $respuesta['respuesta']=$resultado;
        echo json_encode($respuesta, true);

    }else{
        
        $respuesta['exito']=false;
        $respuesta['respuesta']="Dato faltante";
        echo json_encode($respuesta, true);
        
    }

?>