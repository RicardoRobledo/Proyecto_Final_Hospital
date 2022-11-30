<?php

    header("Content-Type: application/json");
    include '../scripts/php/conexionDB/Singleton.php';
    include '../scripts/php/controlador/paciente_dao.php';
    include '../scripts/php/modelo/Paciente.php';
    
    $respuesta = array();
    
    if(isset($_POST['nombre']) &
       isset($_POST['apellido_paterno']) &
       isset($_POST['apellido_materno']) &
       isset($_POST['num_telefono']) &
       isset($_POST['edad']) &
       isset($_POST['sexo']) &
       isset($_POST['direccion'])){

        $paciente = new Paciente(
            null,
            $_POST['nombre'],
            $_POST['apellido_paterno'],
            $_POST['apellido_materno'],
            $_POST['num_telefono'],
            $_POST['edad'],
            $_POST['sexo'],
            $_POST['direccion']
        );

        Singleton::obtenerConexion();
        $pacienteDao = new PacienteDAO();
        $res=$pacienteDao->agregarPaciente($paciente);
        
        $respuesta['exito']=true;
        $respuesta['respuesta']=$res;

        echo json_encode($respuesta,true);
    }else{
        $respuesta['exito']=false;
        $respuesta['respuesta']="Datos faltantes";
        echo json_encode($respuesta, true);
    }

?>