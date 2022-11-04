<?php

    include('paciente_dao.php');

    $no_control = $_GET['id_paciente'];


    //echo $no_control;

    $datos_correctos = true;

    if($datos_correctos){
        $aDAO = new PacienteDAO();
        Singleton::obtenerConexion();
        $resultado = $aDAO->eliminarPaciente($no_control);
        //echo($no_control);
        if($resultado){
            header('Location: ../vista/pacientes.php');
        }else{
            echo "Paciente no eliminado";
        }
    }

?>