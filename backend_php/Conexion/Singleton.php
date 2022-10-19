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
    #                         Inicio de sesion
    # ----------------------------------------------------------------
    public static function iniciarSesion($nombre_usuario, $contrasenia)
    {

        $sql = '
        SELECT * FROM
            usuarios
        WHERE
            nombre_usuario=? AND contrasenia=MD5(?)
        ';

        $query = Singleton::$conexion->prepare($sql);
    	Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    	$query->bindParam(1, $nombre_usuario, PDO::PARAM_STR);
    	$query->bindParam(2, $contrasenia, PDO::PARAM_STR);
    	$query->execute();
    	
        //Si la consulta se realiza con exito
    	if($query->fetch(PDO::FETCH_ASSOC)){
    		return true;
    	}else{
    		return false;
    	}

    }

}

Singleton::obtenerConexion();
print(Singleton::iniciarSesion('toffy', '1234'));
#Singleton::cerrarConexion();
?>
