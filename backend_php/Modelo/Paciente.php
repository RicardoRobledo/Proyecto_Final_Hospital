<?php

class Paciente
{
	private $id_paciente;
	private $nombre;
	private $apellido_paterno;
	private $apellido_materno;
	private $num_telefono;
	private $edad;
	private $sexo;
	private $direccion;
	
	public function __construct($id_paciente=null, $nombre=null, $apellido_paterno=null, $apellido_materno=null, $num_telefono=null, $edad=null, $sexo=null, $direccion=null)
	{
		$this->id_paciente = $id_paciente;
		$this->nombre = $nombre;
		$this->apellido_paterno = $apellido_paterno;
		$this->apellido_materno = $apellido_materno;
		$this->num_telefono = $num_telefono;
		$this->edad = $edad;
		$this->sexo = $sexo;
		$this->direccion = $direccion;
	}

	public function getIdPaciente(){
		return $this->id_paciente;
	}

	public function setIdPaciente($id_paciente){
        $this->id_paciente = $id_paciente;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
        $this->nombre = $nombre;
	}

	public function getApellidoPaterno(){
		return $this->apellido_paterno;
	}

	public function setApellidoPaterno($apellido_paterno){
		$this->apellido_paterno = $apellido_paterno;
	}

	public function getApellidoMaterno(){
		return $this->apellido_materno;
	}

	public function setApellidoMaterno($apellido_materno){
		$this->apellido_materno = $apellido_materno;
	}

	public function getNumTelefono(){
		return $this->num_telefono;
	}

	public function setNumTelefono($num_telefono){
		$this->num_telefono = $num_telefono;
	}

	public function getEdad(){
		return $this->edad;
	}

	public function setEdad($edad){
		$this->edad = $edad;
	}

	public function getSexo(){
		return $this->sexo;
	}

	public function setSexo($sexo){
		$this->sexo = $sexo;
	}

    public function getDireccion(){
		return $this->direccion;
	}

	public function setDireccion($direccion){
		$this->direccion = $direccion;
	}

}
?>

