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
         * Descripción: insertar un nuevo elemento en la base de datps
         */
        function Insertar($id, $asignatura_id, $alumno_id){   
            throw new Exception("Not Implement", 1);            
            try{
                $this->conexionDB = new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                // COMANDOS SQL A SER EJECUTADOS
                $sqlQuery = " INSERT INTO ASIGNATURA_HAS_ALUMNO(ID, asignatura_id, alumno_id) ";
                $sqlQuery = $sqlQuery." values( $id , $asignatura_id , $alumno_id) ";
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();
                return true;
            }catch(Exception $error){
                // DISPARA ERROR
                echo "Error in class Asignatura_has_alumno, function Insertar - Error" + $error->getMessage();
                return false;
            }   
        }
        /**
         * Descripción: elimina un elemneto de la base de datos
         */
        function Eliminar($id){  
            throw new Exception("Not Implement", 1);             
            try{
                $this->conexionDB = new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                // COMANDOS SQL A SER EJECUTADOS
                $sqlQuery = " DELETE FROM ASIGNATURA_HAS_ALUMNO ";
                $sqlQuery = $sqlQuery." WHERE ID = $id ";
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();
                return true;
            }catch(Exception $error){
                // DISPARA ERROR
                echo "Error in class Asignatura_has_alumno, function Eliminar - Error" + $error->getMessage();
                return false;
            }   
        }
        /**
         * Descripción: Modifica un elemento de la base de datos
         */
        function Editar($id, $asignatura_id, $alumno_id){   
            try{
                $this->conexionDB = new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                // COMANDOS SQL A SER EJECUTADOS
                $sqlQuery = " UPDATE ASIGNATURA_HAS_ALUMNO ";
                $sqlQuery = $sqlQuery." SET ASIGNATURA_ID = $asignatura_id , ALUMNO_ID= $alumno_id ";
                $sqlQuery = $sqlQuery." WHERE ID = $id ";
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();
                return true;
            }catch(Exception $error){
                // DISPARA ERROR
                echo "Error in class Asignatura_has_alumno, function Insertar - Error" + $error->getMessage();
                return false;
            }   
        }
        /**
         * Descripción: Busca un elemento dentro de la base de datos
         */
        function Buscar(){  
            throw new Exception("Not Implement", 1);             
            try{
                $this->conexionDB = new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                // COMANDOS SQL A SER EJECUTADOS
                $sqlQuery = "";
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();
                
                // RECORRIDO DEL RESULTADO Y GENERACIÓN DE ARREGLO 2 DIMENSIONES
                $arrayResult = array();                
                while($fila = $sqlResult->fetch_assoc()){
                    $arrayTmp= array();
                    $arrayTmp['id'] = $fila['id'];
                    $arrayTmp['asignatura_id'] = $fila['asignatura_id'];
                    $arrayTmp['alumno_id'] = $fila['alumno_id'];
                    $arrayResult[]= $arrayTmp;
                }
                return $arrayResult;
            }catch(Exception $error){
                // DISPARA ERROR
                echo "Error in class Asignatura_has_alumno, function Busqueda - Error" + $error->getMessage();
                return array();
            }   
        }
        /**
         * Descripción: Busca un registro existente y si este existe en la base de datos, 
         * retorna un true
         */
        function ExisteRegistro($id){ 
            throw new Exception("Not Implement", 1);              
            try{
                $this->conexionDB = new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                // COMANDOS SQL A SER EJECUTADOS
                $sqlQuery = " SELECT * FROM ASIGNATURA_HAS_ALUMNO AS AHA ";
                $sqlQuery = $sqlQuery." WHERE AHA.ID = $id ";
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();
                
                // RECORRIDO DEL RESULTADO Y GENERACIÓN DE ARREGLO 2 DIMENSIONES
                $arrayResult = array();                
                while($fila = $sqlResult->fetch_assoc()){
                    $arrayTmp= array();
                    $arrayTmp['id'] = $fila['id'];
                    $arrayResult[]= $arrayTmp;
                }
                return $arrayResult;
            }catch(Exception $error){
                // DISPARA ERROR
                echo "Error in class Asignatura_has_alumno, function Busqueda - Error" + $error->getMessage();
                return array();
            }   
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
