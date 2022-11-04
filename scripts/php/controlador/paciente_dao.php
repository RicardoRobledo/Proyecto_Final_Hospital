<?php
    
    include ("../conexionDB/Singleton.php");
    include ("../modelo/Paciente.php");

    class PacienteDAO{
        private $conexion;
        public function __construct(){
            //$this->conexion=Singleton::obtenerConexion();
        }

        
        //========================= METODOS ABCC============================

        //===================== ALTAS ==========================

        public function agregarPaciente($paciente){
            $res =Singleton::altaPaciente($paciente);
            return $res;
        }

        //===================== CONSULTAS ==========================
        public function mostrarPacientes(){
            $res =Singleton::consultaPacientes();
            return $res;
        }
        //===================== BAJAS ==========================
        public function eliminarPaciente($id){
            $paciente = new Paciente(
                $id,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            );
            var_dump("<br>");
            var_dump($paciente);
            $res =Singleton::bajaPaciente($paciente);
            return $res;
        }
        //===================== Cambios ==========================
    }//ALUMNO DAO
?>