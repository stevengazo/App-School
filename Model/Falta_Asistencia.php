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
            echo "Error in obtenerListaFaltaAsistencia. Error" + $error->getMessage();
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
    }

    /**
     * Descripción: insetar una nueva Falta asistencia
     * Retorna: true si lo inserta, false si presenta error
     */
    function insertarFaltaAsistencia()
    {
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
