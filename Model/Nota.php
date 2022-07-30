<?php
    /**
     * Dependencias
     */
    require_once "./connections/conexion.php";


    // Modelo de clase para las notas
    class Nota{

        // Conexión a la Base de Datos
        private $conexionDB;

        // Implementación en Singleton
        private static $instancia  = null;

        /**
         * Funcion para comprobar si hay más de una instancia creada, si no hay, la inicializa
         */
        public static function getInstancia(){
            if(self::$instancia == null){
                self::$instancia = new Nota();                
            }
            return self::$instancia;
        }


        public function __construct()
        {
            
        }
        
        /**
         * id: id de la nota a buscar n\
         * Descripción: consulta en la base de datos el id de una nota y devuelve el registro.
         * Retorna:
         */
       public function obtenerNota($id){
            try{
                $this->conexionDB= new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                $sqlQuery = " SELECT * FROM Nota where id = $id  ";
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();

                return $sqlQuery;
            }catch(Exception $error){
                echo "Error in class Nota, function obtenerNota - Error" + $error->getMessage();
                return null;                
            }
        }


        /**
         * Descripción: obtiene la nota por medio de un id
         */
        public function obtenerNotaPorId($id){
            try{
                $this->conexionDB= new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                $sqlQuery = "select N.id, trimestre, nota,AA.id as asignatura_has_alumno_id  , A.id as alumnoId , A.nombre, A.apellidos, ASG.id as asignaturaId, ASG.nombre as asignaturaNombre from nota as N ";
                $sqlQuery = $sqlQuery." inner join asignatura_has_alumno as AA on N.asignatura_has_alumno_id = AA.id ";
                $sqlQuery = $sqlQuery." inner join alumno as A on AA.alumno_id = A.id ";
                $sqlQuery = $sqlQuery." inner join asignatura as ASG on AA.asignatura_id = ASG.id ";                                
                $sqlQuery = $sqlQuery." where N.id = $id";
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();
                $arrayResult = array();
                while($file = $sqlResult->fetch_assoc()){
                    $arrayTemp = array();
                    $arrayTemp['id'] = $file['id'];
                    $arrayTemp['trimestre'] = $file['trimestre'];
                    $arrayTemp['nota'] = $file['nota'];
                    $arrayTemp['alumnoId'] = $file['alumnoId'];
                    $arrayTemp['asignatura_has_alumno_id']= $file['asignatura_has_alumno_id'];
                    $arrayTemp['nombre'] = $file['nombre'];
                    $arrayTemp['apellidos'] = $file['apellidos'];
                    $arrayTemp['asignaturaId'] = $file['asignaturaId'];
                    $arrayTemp['asignaturaNombre'] = $file['asignaturaNombre'];
                    $arrayResult[] =$arrayTemp;
                }
                return $arrayResult;
            }catch(Exception $error){
                echo "Error in class Nota, function obtenerListaNotas - Error".$error->getMessage();
                return null;
            }
        }
    
        /**
         * Descripción: Consulta la base de datos y retorna todas las notas existentes. \n
         * Retorna: array de notas 
         */
        public function obtenerListaNotas(){
            try{
                $this->conexionDB= new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                $sqlQuery = "select N.id, trimestre, nota, A.id as alumnoId , A.nombre, A.apellidos, ASG.id as asignaturaId, ASG.nombre as asignaturaNombre from nota as N ";
                $sqlQuery = $sqlQuery." inner join asignatura_has_alumno as AA on N.asignatura_has_alumno_id = AA.id ";
                $sqlQuery = $sqlQuery." inner join alumno as A on AA.alumno_id = A.id ";
                $sqlQuery = $sqlQuery." inner join asignatura as ASG on AA.asignatura_id = ASG.id; ";                                
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();
                $arrayResult = array();
                while($file = $sqlResult->fetch_assoc()){
                    $arrayTemp = array();
                    $arrayTemp['id'] = $file['id'];
                    $arrayTemp['trimestre'] = $file['trimestre'];
                    $arrayTemp['nota'] = $file['nota'];
                    $arrayTemp['alumnoId'] = $file['alumnoId'];
                    $arrayTemp['nombre'] = $file['nombre'];
                    $arrayTemp['apellidos'] = $file['apellidos'];
                    $arrayTemp['asignaturaId'] = $file['asignaturaId'];
                    $arrayTemp['asignaturaNombre'] = $file['asignaturaNombre'];

                    $arrayResult[] =$arrayTemp;
                }
                return $arrayResult;;
            }catch(Exception $error){
                echo "Error in class Nota, function obtenerListaNotas - Error" + $error->getMessage();
                return null;
            }
        }

        public function UpdateNota($id,$asigAlumTmp,$notaTmp,$trimestreTmp){
            try{
                $this->conexionDB= new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                $sqlQuery = " UPDATE nota ";
                $sqlQuery = $sqlQuery." SET asignatura_has_alumno_id = $asigAlumTmp , trimestre = $trimestreTmp , nota = $notaTmp ";
                $sqlQuery = $sqlQuery." where id = $id ";
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();                
                return true;
            }catch(Exception $error){
                echo "Error in class Nota, function getUltimoId - Error" + $error->getMessage();
                return false;
            }
        }

        /*
         * Descripción: Trae el ultimo id registrado en la base de datos 
         */
        public function getUltimoId(){
            try{
                $this->conexionDB= new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                $sqlQuery = " SELECT id from nota order by id desc limit 1 ";
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();                
                while($file = $sqlResult->fetch_assoc()){
                    return $file['id'];
                }
                //return $arrayResult;;
            }catch(Exception $error){
                echo "Error in class Nota, function getUltimoId - Error" + $error->getMessage();
                return null;
            }
        }


        /**         
         * Descripción: Inserta en la base de datos una nueva nota 
         * Retorna: retorna el id si la inserto, false si presento algún error
         */
       public function insertaNota($id, $asignatura_has_alumno_id,$trimestre, $nota){
            try{
                $this->conexionDB= new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                $sqlQuery = " INSERT INTO nota(id, asignatura_has_alumno_id,trimestre, nota) ";
                $sqlQuery = $sqlQuery." values ($id,$asignatura_has_alumno_id,$trimestre,$nota) "; 
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();
                return true;
            }catch(Exception $error){
                echo "Error in class Nota, function insertaNota - Error". $error->getMessage();
                return false;
            }
        }

        /**
         *  Descripción modifica una nota en especifico, buscada con el id 
         * Retorna: true si la actualizo, false si presento algún error
         */
       public function modificarNota($id, $asignaturaHasAlumnoId , $asignaturaHasAsignaturaId,$trimestre, $nota){
            try{
                $this->conexionDB= new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                $sqlQuery = " UPDATE Nota ";
                $sqlQuery .= " SET   asignatura_has_alumno_alumno_id = $asignaturaHasAlumnoId , asignatura_has_asignatura_id = $asignaturaHasAsignaturaId, trimestre = $trimestre, nota = $nota"; 
                $sqlQuery .= " WHERE  id= $id ";
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();
                return true;
            }catch(Exception $error){
                echo "Error in class Nota, function modificarNota - Error" + $error->getMessage();
                return null;
            }
        }
        /**
         *  Descripción: elimina una nota existente en la base de datos. 
         * Retorna: true si la actualizo, false si presento algún error
         */
       public  function borrarNota($id){
            try{
                $this->conexionDB= new conexion();
                $this->objConexion = $this->conexionDB->conectar();
                $sqlQuery = " DELETE FROM Nota where id = $id";                           
                $sqlResult = $this->objConexion->query($sqlQuery);
                $this->conexionDB->desconectar();
                return true;
            }catch(Exception $error){
                echo "Error in class Nota, function borrarNota - Error" + $error->getMessage();
                return false;
            }
        }

        /**
         * Descripción: busca las notas de un alumno en especifico.
         * Retorna: arreglo con las notas del estudiante
         */
        function ObtenerNotasAlumno(){
            throw new Exception("Not Implement", 1);            
        }
        function ObtenerNotasAsignatura(){
            throw new Exception("Not Implement", 1);            
        }        

    }
