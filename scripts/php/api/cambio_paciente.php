<?php
    
    header("Content-Type: application/json");
    include '../scripts/php/conexionDB/Singleton.php';
    include '../scripts/php/modelo/Paciente.php';
    include '../scripts/php/controlador/paciente_dao.php';
    
    parse_str(file_get_contents("php://input"), $put_vars);
    
    $respuesta = array();
    $respuesta['exito'] = false;
    
    if(isset($_GET['id_paciente']) &
       isset($put_vars['nombre']) &
       isset($put_vars['apellido_paterno']) &
       isset($put_vars['apellido_materno']) &
       isset($put_vars['num_telefono']) &
       isset($put_vars['edad']) &
       isset($put_vars['sexo']) &
       isset($put_vars['direccion'])){
        
        $paciente = new Paciente(
            $_GET['id_paciente'],
            $put_vars['nombre'],
            $put_vars['apellido_paterno'],
            $put_vars['apellido_materno'],
            $put_vars['num_telefono'],
            $put_vars['edad'],
            $put_vars['sexo'],
            $put_vars['direccion']
        );

        Singleton::obtenerConexion();
        $pacienteDao = new PacienteDAO();
        $res=Singleton::pacienteConsulta($paciente);

        if($res==true){
            $res=$pacienteDao->actualizarPaciente($paciente);
            $respuesta['exito'] = true;
            $respuesta['respuesta'] = $res;
            echo json_encode($respuesta,true);
        }else{
            $respuesta['exito'] = false;
            $respuesta['respuesta'] = "Usuario inexistente";
            echo json_encode($respuesta, true);
        }

    }else{
        $respuesta['respuesta'] = "Datos faltantes";
        echo json_encode($respuesta, true);
    }

?>