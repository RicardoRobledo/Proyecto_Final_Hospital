<?php

class Analisis
{

	private $id_paciente;
	private $tipo_analisis;
	
	public function __construct($id_paciente=null, $tipo_analisis=null)
	{
		$this->id_paciente = $id_paciente;
		$this->tipo_analisis = $tipo_analisis;
	}

	public function getIdPaciente(){
		return $this->id_paciente;
	}

	public function setIdPaciente($id_paciente){
		$this->id_paciente = $id_paciente;
	}

	public function getTipoAnalisis(){
		return $this->tipo_analisis;
	}
	
	public function setTipoAnalisis($tipo_analisis){
		$this->tipo_analisis = $tipo_analisis;
	}

}
?>