<?php
//author: Ricardo Robledo
//version: 0.1


//clase que define nuestra conexion con el patron de disenio Singleton
class Singleton
{

	private static $conexion = null;


	private function __construct($file='../backend_settings.ini')
    {

    	$settings = parse_ini_file($file, TRUE); // cargando archivo de configuraciones

    	$dns = $settings['DATABASE']['DRIVER'] . ':host=' . $settings['DATABASE']['HOST'] . ((!empty($settings['DATABASE']['PORT'])) ? (';port=' . $settings['DATABASE']['PORT']) : '') . ';dbname=' . $settings['DATABASE']['SCHEMA'];

    	Singleton::$conexion = new PDO(
    		$dns,
    		$settings['DATABASE']['USERNAME'],
    		$settings['DATABASE']['PASSWORD']
    	);// Uso de PDO

    }


	public static function obtenerConexion()
    {

		if(Singleton::$conexion==null)
	    {
            new Singleton();
        }

        print('Conexion obtenida');

        return Singleton::$conexion;
		
    }

    # ----------------------------------------------------------------
    #                         Cerrar conexion
    # ----------------------------------------------------------------
    public static function cerrarConexion()
    {
        Singleton::$conexion = null;
    }

    
    # ----------------------------------------------------------------
    #                             Usuario
    # ----------------------------------------------------------------
    public static function iniciarSesion($nombre_usuario, $contrasenia)
    {

        $sql = 'SELECT sp_login(?,?)';

        $query = Singleton::$conexion->prepare($sql);
    	Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    	$query->bindParam(1, $nombre_usuario, PDO::PARAM_STR);
    	$query->bindParam(2, $contrasenia, PDO::PARAM_STR);
    	$query->execute();

        //Si la consulta se realiza con exito
    	if($query->fetch(PDO::FETCH_ASSOC)['sp_login']==''){
    		return false;
    	}else{
    		return true;
    	}

    }


    # ----------------------------------------------------------------
    #                             Paciente
    # ----------------------------------------------------------------
    public static function altaPaciente($paciente)
    {

        $sql = 'INSERT INTO pacientes(nombre, apellido_paterno, apellido_materno, num_telefono, edad, sexo, direccion) VALUES (?,?,?,?,?,?,?)';

        $query = Singleton::$conexion->prepare($sql);
        Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $query->bindValue(1, $paciente->getNombre(), PDO::PARAM_STR);
        $query->bindValue(2, $paciente->getApellidoPaterno(), PDO::PARAM_STR);
        $query->bindValue(3, $paciente->getApellidoMaterno(), PDO::PARAM_STR);
        $query->bindValue(4, $paciente->getNumTelefono(), PDO::PARAM_STR);
        $query->bindValue(5, $paciente->getEdad(), PDO::PARAM_INT);
        $query->bindValue(6, $paciente->getSexo(), PDO::PARAM_STR);
        $query->bindValue(7, $paciente->getDireccion(), PDO::PARAM_STR);
        $resultado = $query->execute();

        if($resultado){
            return true; 
        }else{
            return false;
        }

    }


    public static function bajaPaciente($paciente)
    {

        $sql = 'DELETE FROM pacientes WHERE id_paciente=?';

        $query = Singleton::$conexion->prepare($sql);
        Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $query->bindValue(1, $paciente->getIdPaciente(), PDO::PARAM_INT);
        $resultado = $query->execute();

        if($resultado){
            return true; 
        }else{
            return false;
        }

    }


    public static function cambioPaciente($paciente)
    {

        $sql = 'UPDATE pacientes SET nombre=?, apellido_paterno=?, apellido_materno=?, num_telefono=?, edad=?, sexo=?, direccion=? WHERE id_paciente=?';

        $query = Singleton::$conexion->prepare($sql);
        Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $query->bindValue(1, $paciente->getNombre(), PDO::PARAM_STR);
        $query->bindValue(2, $paciente->getApellidoPaterno(), PDO::PARAM_STR);
        $query->bindValue(3, $paciente->getApellidoMaterno(), PDO::PARAM_STR);
        $query->bindValue(4, $paciente->getNumTelefono(), PDO::PARAM_STR);
        $query->bindValue(5, $paciente->getEdad(), PDO::PARAM_INT);
        $query->bindValue(6, $paciente->getSexo(), PDO::PARAM_STR);
        $query->bindValue(7, $paciente->getDireccion(), PDO::PARAM_STR);
        $query->bindValue(8, $paciente->getIdPaciente(), PDO::PARAM_INT);
        $resultado = $query->execute();

        if($resultado){
            return true; 
        }else{
            return false;
        }

    }


    public static function generarConsulta($paciente)
    {

        $sql = 'SELECT * FROM pacientes WHERE ';

        if($paciente->getIdPaciente()!=null){
            $sql = $sql . 'id_paciente=? AND ';
        }

        if($paciente->getNombre()!=null){
            $sql = $sql . 'nombre=? AND ';
        }

        if($paciente->getApellidoPaterno()!=null){
            $sql = $sql . 'apellido_paterno=? AND ';
        }

        if($paciente->getApellidoMaterno()!=null){
            $sql = $sql . 'apellido_materno=? AND ';
        }

        if($paciente->getNumTelefono()!=null){
            $sql = $sql . 'num_telefono=? AND ';
        }

        if($paciente->getEdad()!=null){
            $sql = $sql . 'edad=? AND ';
        }

        if($paciente->getSexo()!=null){
            $sql = $sql . 'sexo=? AND ';
        }

        if($paciente->getDireccion()!=null){
            $sql = $sql . 'direccion=? AND ';
        }

        return $sql;

    }


    public static function consultar($sql, $paciente)
    {

        $cont = 1;
        $query = Singleton::$conexion->prepare(substr($sql, 0, strlen($sql)-5));

        Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        if($paciente->getIdPaciente()!=null){
            $query->bindValue($cont, $paciente->getIdPaciente(), PDO::PARAM_INT);
            $cont++;
        }

        if($paciente->getNombre()!=null){
            $query->bindValue($cont, $paciente->getNombre(), PDO::PARAM_STR);
            $cont++;
        }

        if($paciente->getApellidoPaterno()!=null){
            $query->bindValue($cont, $paciente->getApellidoPaterno(), PDO::PARAM_STR);
            $cont++;
        }

        if($paciente->getApellidoMaterno()!=null){
            $query->bindValue($cont, $paciente->getApellidoMaterno(), PDO::PARAM_STR);
            $cont++;
        }

        if($paciente->getNumTelefono()!=null){
            $query->bindValue($cont, $paciente->getNumTelefono(), PDO::PARAM_STR);
            $cont++;
        }

        if($paciente->getEdad()!=null){
            $query->bindValue($cont, $paciente->getEdad(), PDO::PARAM_INT);
            $cont++;
        }

        if($paciente->getSexo()!=null){
            $query->bindValue($cont, $paciente->getSexo(), PDO::PARAM_STR);
            $cont++;
        }

        if($paciente->getDireccion()!=null){
            $query->bindValue($cont, $paciente->getDireccion(), PDO::PARAM_STR);
        }

        return $query;

    }


    public static function consultaPaciente($paciente)
    {

        $sql = Singleton::generarConsulta($paciente);
        $query = Singleton::consultar($sql, $paciente);
        $resultado = $query->execute();

        #foreach($query->fetch(PDO::FETCH_ASSOC) as $key => $value) {
        #    print(var_dump($key, $value).'<br>');
        #}

        return $resultado;

    }


    # ----------------------------------------------------------------
    #                             Parto
    # ----------------------------------------------------------------

    # ----------------------------------------------------------------
    #                             Analisis
    # ----------------------------------------------------------------

}

Singleton::obtenerConexion();
?>