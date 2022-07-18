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
            $sqlQuery = "SELECT id, alumno_id,asignatura_id, fecha, justificada FROM falta_asistencia";
            $sqlResults = $this->objConexion->query($sqlQuery);
            $this->conexionDb->desconectar();

            $arrayResult = array();
            while($fila = $sqlResults->fetch_assoc()){
                $arrayTmp= array();
                $arrayTmp['id'] = $fila['id'];
                $arrayTmp['alumno_id'] = $fila['alumno_id'];
                $arrayTmp['asignatura_id'] = $fila['asignatura_id'];
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
            $sqlQuery = "SELECT id, alumno_id,asignatura_id, fecha, justificada FROM falta_asistencia where id = $id";
            $sqlResults = $this->objConexion->query($sqlQuery);
            $this->conexionDb->desconectar();

            $arrayResult = array();
            while($fila = $sqlResults->fetch_assoc()){
                $arrayTmp= array();
                $arrayTmp['id'] = $fila['id'];
                $arrayTmp['alumno_id'] = $fila['alumno_id'];
                $arrayTmp['asignatura_id'] = $fila['asignatura_id'];
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
            echo "iniciando conexión a la db...";
            $this->conexionDb = new conexion();
            $this->objConexion = $this->conexionDb->conectar();
            // QUERY PARA INGRESAR A LA DB
            $sqlQuery = "INSERT INTO falta_asistencia( id, alumno_id,asignatura_id, fecha, justificada) ";
            $sqlQuery .= " values ($_id, 	$_alumno_id, $_asignatura_id, '$_fecha', '$_justificada'	);";
            $sqlResults = $this->objConexion->query($sqlQuery);
            $this->conexionDb->desconectar();
            echo "cerrando conexión a la db";
            return true;
        }catch(Exception $error){
            echo "Error in insertarFaltaAsistencia- Class Falta_Asistencia.php;<hr>Error ".$error->getMessage();
            return null;
        }  

    }
    /**
     * 
     */
    function modificarFaltaAsistencia()
    {
    }
    /**
     * 
     */
    function EliminarFaltaAsistencia()
    {
    }
    /**
     * 
     */
    function justificadaFaltaAsistencia($id, $Justificada)
    {
    }
}
