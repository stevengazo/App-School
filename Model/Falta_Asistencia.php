<?php

/**
 * DEPENDENCIAS
 */
require_once "connections/conexion.php";
class Falta_Asistencia
{
    /**
     * Conexión con la Base de Datos
     */
    private $conexionDb;

    /**
     * Implementación con singleton
     */
    private static $instance = null;

    /**
     * Funcion para inicializar singleton
     * Si hay más de una instancia borra  la información
     */
    public static function getInstancia(){
        if(self::$instance == null ){
            self::$instance = new Falta_Asistencia();
        }
        return self::$instance;
    }    

    public function __construct()
    {
    }

    /**
     * Descripción: obtiene todas las faltas de asistencia registradas.
     * Retorna: arreglo con la listas
     */
    function obtenerListaFaltaAsistencia()
    {
        try{
            $this->conexionDb = new conexion();
            $this->objConexion = $this->conexionDb->conectar();
            $sqlQuery = "select falta_asistencia.id, alumno.nombre, alumno.apellidos, asignatura.nombre as nombreAsignatura  , fecha, justificada from falta_asistencia";
            $sqlQuery = $sqlQuery." inner join alumno on alumno.id = falta_asistencia.alumno_id ";
            $sqlQuery = $sqlQuery." inner join asignatura on falta_asistencia.asignatura_id = asignatura.id";
            $sqlResults = $this->objConexion->query($sqlQuery);
            $this->conexionDb->desconectar();

            $arrayResult = array();
            while($fila = $sqlResults->fetch_assoc()){
                $arrayTmp= array();
                $arrayTmp['id'] = $fila['id'];
                $arrayTmp['nombre'] = $fila['nombre'];
                $arrayTmp['apellidos'] = $fila['apellidos'];
                $arrayTmp['asignatura'] = $fila['nombreAsignatura'];
                $arrayTmp['fecha'] = $fila['fecha'];
                $arrayTmp['justificada'] = $fila['justificada'];
                $arrayResult[]= $arrayTmp;
            }
            return $arrayResult;
        }catch(Exception $error){
            echo "Error in obtenerListaFaltaAsistencia. Error".$error->getMessage();
            return null;
        }
    }

    /**
     * Argumento: id de la asistencia a buscar en la Db
     * Descrpción: busca un id en la tabla Falta_Asistencia y retorna los resultados
     * Retorno: objeto de tipo Falta Asistencia
     */
    function obtenerFaltaAsistencia($id)
    {
        try{
            $this->conexionDb = new conexion();
            $this->objConexion = $this->conexionDb->conectar();
            $sqlQuery = "select falta_asistencia.id, alumno.id as alumnoId, asignatura.id as asignaturaId, alumno.nombre, alumno.apellidos, asignatura.nombre as nombreAsignatura , fecha, justificada from falta_asistencia";
            $sqlQuery = $sqlQuery." inner join alumno on alumno.id = falta_asistencia.alumno_id  ";
            $sqlQuery = $sqlQuery." inner join asignatura on falta_asistencia.asignatura_id = asignatura.id ";
            $sqlQuery = $sqlQuery." where falta_asistencia.id = $id ";
            $sqlResults = $this->objConexion->query($sqlQuery);
            $this->conexionDb->desconectar();

            $arrayResult = array();
            while($fila = $sqlResults->fetch_assoc()){
                $arrayTmp= array();
                $arrayTmp['id'] = $fila['id'];
                $arrayTmp['alumno_id'] = $fila['alumnoId'];
                $arrayTmp['asignatura_id'] = $fila['asignaturaId'];
                $arrayTmp['nombre'] = $fila['nombre'];
                $arrayTmp['apellidos'] = $fila['apellidos'];
                $arrayTmp['asignatura'] = $fila['nombreAsignatura'];
                $arrayTmp['fecha'] = $fila['fecha'];
                $arrayTmp['justificada'] = $fila['justificada'];
                $arrayResult[]= $arrayTmp;
            }
            return $arrayResult;
        }catch(Exception $error){
            echo "Error in obtenerListaFaltaAsistencia. Error".$error->getMessage();
            return null;
        }
    }
    

    function getLastId(){
        try{
            $this->conexionDb = new conexion();
            $this->objConexion = $this->conexionDb->conectar();
            $sqlQuery = "select id from falta_asistencia order by id desc limit 1";
            $sqlResults = $this->objConexion->query($sqlQuery);
            $this->conexionDb->desconectar();
            $result = null;
            while($fila = $sqlResults->fetch_assoc()){
                $result= $fila['id'];                
            }
            
            return $result;
        }catch(Exception $error){
            echo "Error in obtenerListaFaltaAsistencia. Error".$error->getMessage();
            return null;
        }  
    }

    /**
     * Descripción: insetar una nueva Falta asistencia
     * Retorna: true si lo inserta, false si presenta error
     */
    function insertarFaltaAsistencia($_id,$_alumno_id,$_asignatura_id, $_fecha,$_justificada)
    {
        try{
            
            $this->conexionDb = new conexion();
            $this->objConexion = $this->conexionDb->conectar();
            // QUERY PARA INGRESAR A LA DB
            $sqlQuery = "INSERT INTO falta_asistencia( id, alumno_id,asignatura_id, fecha, justificada) ";
            $sqlQuery .= " values ($_id, 	$_alumno_id, $_asignatura_id, '$_fecha', '$_justificada'	);";
            $sqlResults = $this->objConexion->query($sqlQuery);
            $this->conexionDb->desconectar();
            return true;
        }catch(Exception $error){
            echo "Error in insertarFaltaAsistencia- Class Falta_Asistencia.php;<hr>Error ".$error->getMessage();
            return null;
        }  
    }
    /**
     * 
     */
    function modificarFaltaAsistencia($id,$alumno_id,$asignatura_id,$fecha,$justificada)    
    {
        try{
            $this->conexionDb = new conexion();
            $this->objConexion = $this->conexionDb->conectar();
            // QUERY PARA INGRESAR A LA DB
           $sqlQuery = "UPDATE falta_asistencia  ";
            $sqlQuery = $sqlQuery." set  alumno_id = $alumno_id, asignatura_id = $asignatura_id, fecha = '$fecha', justificada = '$justificada'";
            $sqlQuery = $sqlQuery." WHERE id = $id;";
            $sqlResults = $this->objConexion->query($sqlQuery);
            $this->conexionDb->desconectar();            
            return true;
        }catch(Exception $error){
            echo "Error in modificarFaltaAsistencia- Class Falta_Asistencia.php;<hr>Error ".$error->getMessage();
            return false;
        }  
    }
    /**
     * 
     */
    function EliminarFaltaAsistencia ($id)
    {
        try{
            echo "iniciando conexión a la db...";
            $this->conexionDb = new conexion();
            $this->objConexion = $this->conexionDb->conectar();
            // QUERY PARA INGRESAR A LA DB
            $sqlQuery = "DELETE FROM falta_asistencia WHERE id = $id ";
            $sqlResults = $this->objConexion->query($sqlQuery);
            $this->conexionDb->desconectar();
            echo "cerrando conexión a la db";
            return true;
        }catch(Exception $error){
            echo "Error in EliminarFaltaAsistencia- Class Falta_Asistencia.php;<hr>Error ".$error->getMessage();
            return false;
        }  
    }
    /**
     * 
     */
    function justificadaFaltaAsistencia($id, $Justificada)
    {
    }
}
