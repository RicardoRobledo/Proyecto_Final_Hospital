<?php
//clase que define nuestra conexion con el patron de disenio Singleton
class Singleton{

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

       // print('Conexion obtenida');

        return Singleton::$conexion;
		
    }


    public static function cerrarConexion()
    {
        Singleton::$conexion = null;
    }

    
    # ----------------------------------------------------------------
    #                             Usuario
    # ----------------------------------------------------------------
    public static function iniciarSesion($nombre_usuario, $contrasenia){

        $sql = 'CALL sp_login(?,?)';

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


    # ----------------------------------------------------------------
    #                             Paciente
    # ----------------------------------------------------------------
    public static function altaPaciente($paciente){
        try{

            Singleton::$conexion->beginTransaction();

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
            $query->execute();

            $resultado = Singleton::$conexion->commit();

            return true;

        }catch(Exception $e){
            Singleton::$conexion->rollBack();
        }

        return false;

    }


    public static function bajaPaciente($paciente)
    {
        try{

            Singleton::$conexion->beginTransaction();

            $sql = 'DELETE FROM pacientes WHERE id_paciente=?';

            $query = Singleton::$conexion->prepare($sql);
            Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $query->bindValue(1, $paciente->getIdPaciente(), PDO::PARAM_INT);
            $query->execute();

            $resultado = Singleton::$conexion->commit();

            return true;

        }catch(Exception $e){
            Singleton::$conexion->rollBack();
        }

        return false;

    }


    public static function cambioPaciente($paciente)
    {
        try{

            Singleton::$conexion->beginTransaction();

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
            $query->execute();

            $resultado = Singleton::$conexion->commit();

            return true;

        }catch(Exception $e){
            Singleton::$conexion->rollBack();
        }

        return false;

    }


    public static function generarConsultaPaciente($paciente){

        $sql = 'SELECT * FROM pacientes WHERE ';

        if($paciente->getIdPaciente()!=null){
            $sql = $sql . 'id_paciente LIKE %?% OR ';
        }

        if($paciente->getNombre()!=null){
            $sql = $sql . 'nombre LIKE %?% OR ';
        }

        if($paciente->getApellidoPaterno()!=null){
            $sql = $sql . 'apellido_paterno LIKE %?% OR ';
        }

        if($paciente->getApellidoMaterno()!=null){
            $sql = $sql . 'apellido_materno LIKE %?% OR ';
        }

        if($paciente->getNumTelefono()!=null){
            $sql = $sql . 'num_telefono LIKE %?% OR ';
        }

        if($paciente->getEdad()!=null){
            $sql = $sql . 'edad LIKE %?% OR ';
        }

        if($paciente->getSexo()!=null){
            $sql = $sql . 'sexo LIKE %?% OR ';
        }

        if($paciente->getDireccion()!=null){
            $sql = $sql . 'direccion LIKE %?%';
        }

        return $sql;

    }


    public static function consultarPaciente($sql, $paciente){

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

    public static function consultaPacientes(){

        $sql = 'SELECT * FROM pacientes';

        $query = Singleton::$conexion->prepare($sql);
    	Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    	$query->execute();

        //Si la consulta se realiza con exito
    	return $query;


    }
    public static function consultaPaciente($paciente){
        //var_dump($paciente);
        $sql = Singleton::generarConsultaPaciente($paciente);
        //readonly
        var_dump($sql);
        $query = Singleton::consultarPaciente($sql, $paciente);
        //var_dump($query."Soy la consulta");
        $query->execute();

        return $query;//->fetchAll();

    }


    # ----------------------------------------------------------------
    #                             Parto
    # ----------------------------------------------------------------


    public static function altaParto($parto)
    {
        try{

            Singleton::$conexion->beginTransaction();

            $sql = 'INSERT INTO partos(id_madre, fecha_parto, nombre_partera) VALUES (?,?,?)';

            $query = Singleton::$conexion->prepare($sql);
            Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $query->bindValue(1, $parto->getIdMadre(), PDO::PARAM_INT);
            $query->bindValue(2, $parto->getFechaParto(), PDO::PARAM_STR);
            $query->bindValue(3, $parto->getNombrePartera(), PDO::PARAM_STR);
            $query->execute();

            $resultado = Singleton::$conexion->commit();

            return true;

        }catch(Exception $e){
            Singleton::$conexion->rollBack();
        }

        return false;

    }


    public static function bajaParto($parto)
    {
        try{

            Singleton::$conexion->beginTransaction();

            $sql = 'DELETE FROM partos WHERE id_parto=?';

            $query = Singleton::$conexion->prepare($sql);
            Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $query->bindValue(1, $parto->getIdParto(), PDO::PARAM_INT);
            $query->execute();

            $resultado = Singleton::$conexion->commit();

            return true;

        }catch(Exception $e){
            Singleton::$conexion->rollBack();
        }

        return false;

    }


    public static function cambioParto($parto)
    {
        try{

            Singleton::$conexion->beginTransaction();

            $sql = 'UPDATE partos SET id_madre=?, fecha_parto=?, nombre_partera=? WHERE id_parto=?';

            print($parto->getFechaParto());
            $query = Singleton::$conexion->prepare($sql);
            Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $query->bindValue(1, $parto->getIdMadre(), PDO::PARAM_INT);
            $query->bindValue(2, $parto->getFechaParto(), PDO::PARAM_STR);
            $query->bindValue(3, $parto->getNombrePartera(), PDO::PARAM_STR);
            $query->bindValue(4, $parto->getIdParto(), PDO::PARAM_INT);
            $query->execute();

            $resultado = Singleton::$conexion->commit();

            return true;

        }catch(Exception $e){
            Singleton::$conexion->rollBack();
        }

        return false;

    }


    public static function generarConsultaParto($parto)
    {

        $sql = 'SELECT * FROM partos WHERE ';

        if($parto->getIdParto()!=null){
            $sql = $sql . 'id_parto=? AND ';
        }

        if($parto->getIdMadre()!=null){
            $sql = $sql . 'id_madre=? AND ';
        }

        if($parto->getFechaParto()!=null){
            $sql = $sql . 'fecha_parto=? AND ';
        }

        if($parto->getNombrePartera()!=null){
            $sql = $sql . 'nombre_partera=? AND ';
        }

        return $sql;

    }


    public static function consultarParto($sql, $parto)
    {

        $cont = 1;
        $query = Singleton::$conexion->prepare(substr($sql, 0, strlen($sql)-5));

        Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        if($parto->getIdParto()!=null){
            $query->bindValue($cont, $parto->getIdParto(), PDO::PARAM_INT);
            $cont++;
        }

        if($parto->getIdMadre()!=null){
            $query->bindValue($cont, $parto->getIdMadre(), PDO::PARAM_INT);
            $cont++;
        }

        if($parto->getFechaParto()!=null){
            $query->bindValue($cont, $parto->getFechaParto(), PDO::PARAM_STR);
            $cont++;
        }

        if($parto->getNombrePartera()!=null){
            $query->bindValue($cont, $parto->getNombrePartera(), PDO::PARAM_STR);
            $cont++;
        }

        return $query;

    }


    public static function consultaParto($parto)
    {

        $sql = Singleton::generarConsultaParto($parto);
        $query = Singleton::consultarParto($sql, $parto);
        $query->execute();

        return $query->fetchAll();

    }


    # ----------------------------------------------------------------
    #                             Analisis
    # ----------------------------------------------------------------


    public static function altaAnalisis($analisis){
        try{

            Singleton::$conexion->beginTransaction();

            $sql = 'INSERT INTO analisis(id_paciente, tipo_analisis) VALUES (?,?)';

            $query = Singleton::$conexion->prepare($sql);
            Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $query->bindValue(1, $analisis->getIdPaciente(), PDO::PARAM_INT);
            $query->bindValue(2, $analisis->getTipoAnalisis(), PDO::PARAM_STR);
            $query->execute();

            $resultado = Singleton::$conexion->commit();

            return true;

        }catch(Exception $e){
            Singleton::$conexion->rollBack();
        }

        return false;

    }


    public static function bajaAnalisis($analisis){
        try{

            Singleton::$conexion->beginTransaction();

            $sql = 'DELETE FROM analisis WHERE id_analisis=?';

            $query = Singleton::$conexion->prepare($sql);
            Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $query->bindValue(1, $analisis->getIdAnalisis(), PDO::PARAM_INT);
            $query->execute();

            $resultado = Singleton::$conexion->commit();

            return true;

        }catch(Exception $e){
            Singleton::$conexion->rollBack();
        }

        return false;

    }


    public static function cambioAnalisis($analisis){

        try{

            Singleton::$conexion->beginTransaction();

            $sql = 'UPDATE analisis SET id_paciente=?, tipo_analisis=? WHERE id_analisis=?';

            $query = Singleton::$conexion->prepare($sql);
            Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $query->bindValue(1, $analisis->getIdPaciente(), PDO::PARAM_INT);
            $query->bindValue(2, $analisis->getTipoAnalisis(), PDO::PARAM_STR);
            $query->bindValue(3, $analisis->getIdAnalisis(), PDO::PARAM_INT);
            $query->execute();

            $resultado = Singleton::$conexion->commit();

            return true; 

        }catch(Exception $e){
            Singleton::$conexion->rollBack();
        }

        return false;
    
    }


    public static function generarConsultaAnalisis($analisis){

        $sql = 'SELECT * FROM analisis WHERE ';

        if($analisis->getIdAnalisis()!=null){
            $sql = $sql . 'id_analisis=? AND ';
        }

        if($analisis->getIdPaciente()!=null){
            $sql = $sql . 'id_paciente=? AND ';
        }

        if($analisis->getTipoAnalisis()!=null){
            $sql = $sql . 'tipo_analisis=? AND ';
        }

        return $sql;

    }


    public static function consultarAnalisis($sql, $analisis){

        $cont = 1;
        $query = Singleton::$conexion->prepare(substr($sql, 0, strlen($sql)-5));

        Singleton::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        if($analisis->getIdAnalisis()!=null){
            $query->bindValue($cont, $analisis->getIdAnalisis(), PDO::PARAM_INT);
            $cont++;
        }

        if($analisis->getIdPaciente()!=null){
            $query->bindValue($cont, $analisis->getIdPaciente(), PDO::PARAM_INT);
            $cont++;
        }

        if($analisis->getTipoAnalisis()!=null){
            $query->bindValue($cont, $analisis->getTipoAnalisis(), PDO::PARAM_STR);
        }

        return $query;

    }


    public static function consultaAnalisis($analisis){

        $sql = Singleton::generarConsultaAnalisis($analisis);
        $query = Singleton::consultarAnalisis($sql, $analisis);
        $query->execute();

        return $query->fetchAll();

    }


}
Singleton::obtenerConexion();

?>