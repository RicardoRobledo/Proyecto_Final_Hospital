<?php

class Usuario
{

	private $id_usuario;
	private $nombre_usuario;
	private $contrasenia;
	
	public function __construct($id_usuario=null, $nombre_usuario=null, $contrasenia=null)
	{
		$this->id_usuario = $id_usuario;
		$this->nombre_usuario = $nombre_usuario;
		$this->contrasenia = $contrasenia;
	}

	public function getIdUsuario(){
		return $this->id_usuario;
	}

	public function setIdUsuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}

	public function getNombreUsuario(){
		return $this->nombre_usuario;
	}
	
	public function setNombreUsuario($nombre_usuario){
		$this->nombre_usuario = $nombre_usuario;
	}
	
	public function getContrasenia(){
		return $this->contrasenia;
	}
	
	public function setContrasenia($contrasenia){
		$this->contrasenia = $contrasenia;
	}

}
?>
