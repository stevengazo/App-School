<?php
    /**
     * Dependencias
     */
    require_once "./connections/conexion.php";


    // Modelo de clase para las notas
    class Asignatura_has_Alumno{

        // Conexión a la Base de Datos
        private $conexionDB;

        // Implementación en Singleton
        private static $instancia  = null;

        /**
         * Funcion para comprobar si hay más de una instancia creada, si no hay, la inicializa
         */
        public static function getInstancia(){
            if(self::$instancia == null){
                self::$instancia = new Asignatura_has_Alumno();                
            }
            return self::$instancia;
        }


        public function __construct()
        {
           // $this->conexionDB= conexion::getInstance();
        }
        

        /**
         * Descripción: Devuelve un arreglo de las asignaturas y los alumnos inscritos en ellas
         */
        function getArregloAsigAlum(){
            try{
                $this->conexionDB = new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                $sqlQuery = " select 	AsigAlumn.id, AsigAlumn.asignatura_id, 	ASG.nombre as asignaturaNombre,  AsigAlumn.alumno_id, AL.nombre as alumnoNombre, Al.apellidos as alumnoApellidos     ";
                $sqlQuery = $sqlQuery." from asignatura_has_alumno as AsigAlumn ";  
                $sqlQuery = $sqlQuery." inner join asignatura as ASG  on AsigAlumn.asignatura_id = ASG.id ";  
                $sqlQuery = $sqlQuery." inner join alumno as AL  on AsigAlumn.alumno_id = AL.id ";  
                $sqlQuery = $sqlQuery." group by AsigAlumn.id; ";                        
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();
                $arrayResult = array();                
                while($fila = $sqlResult->fetch_assoc()){
                    $arrayTmp= array();
                    $arrayTmp['id'] = $fila['id'];
                    $arrayTmp['asignatura_id'] = $fila['asignatura_id'];
                    $arrayTmp['asignaturaNombre'] = $fila['asignaturaNombre'];
                    $arrayTmp['alumno_id'] = $fila['alumno_id'];
                    $arrayTmp['alumnoNombre'] = $fila['alumnoNombre'];
                    $arrayTmp['alumnoApellidos'] = $fila['alumnoApellidos'];
                    $arrayResult[]= $arrayTmp;
                }
                return $arrayResult;
            }catch(Exception $error){
                echo "Error in class Asignatura_has_alumno, function getArregloAsigAlum - Error" + $error->getMessage();
                return array();
            }   
        }

    }
