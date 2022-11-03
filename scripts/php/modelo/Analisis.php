<?php

class Analisis
{

    private $id_analisis;
	private $id_paciente;
	private $tipo_analisis;
	
	public function __construct($id_analisis=null, $id_paciente=null, $tipo_analisis=null)
	{
		$this->id_analisis = $id_analisis;
		$this->id_paciente = $id_paciente;
		$this->tipo_analisis = $tipo_analisis;
	}

	public function getIdAnalisis(){
		return $this->id_analisis;
	}

	public function setIdAnalisis($id_paciente){
		$this->id_analisis = $id_analisis;
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