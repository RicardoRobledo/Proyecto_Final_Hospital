<?php
    include('paciente_dao.php');
    $paciente = new Paciente(
        $_POST['id'],
        $_POST['nombre'],
        $_POST['Ap_P'],
        $_POST['Ap_M'],
        $_POST['tel'],
        $_POST['edad'],
        $_POST['sexo'],
        $_POST['direccion']
    );
    

    //echo $no_control;
    //echo $nombre;


    //========================== Validacion ======================================

    $datos_correctos=true;

    if($datos_correctos){
        var_dump($paciente);
        $aDAO = new PacienteDAO();
        Singleton::obtenerConexion();
        $resultado=$aDAO->cambiarPaciente($paciente);
        var_dump("<br>");
        var_dump($resultado);
        if($resultado){
            //echo "Ya casi soy ISC INMORTAL!!!!";
            header('location:../vista/pacientes.php');
        }else{
            //echo "No se puede no hay tortillas";
        }
    }

?>