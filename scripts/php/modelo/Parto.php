<?php

class Parto
{

	private $id_madre;
	private $fecha_parto;
    private $nombre_partera;
	
	public function __construct($id_madre=null, $fecha_parto=null, $nombre_partera=null)
	{
		$this->id_madre = $id_madre;
		$this->fecha_parto = $fecha_parto;
		$this->nombre_partera = $nombre_partera;
	}

	public function getIdMadre(){
		return $this->id_madre;
	}

	public function setIdMadre($id_madre){
		$this->id_madre = $id_madre;
	}

	public function getFechaParto(){
		return $this->fecha_parto;
	}
	
	public function setFechaParto($fecha_parto){
		$this->fecha_parto = $fecha_parto;
	}
	
	public function getNombrePartera(){
		return $this->nombre_partera;
	}
	
	public function setNombrePartera($nombre_partera){
		$this->nombre_partera = $nombre_partera;
	}

}
?>