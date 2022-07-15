<?
    /**
     * DEPENDENCIAS
     */
    require_once './connections/conexion.php';


    class Falta_Asistencia{
        /**
         * Conexión con la Base de Datos
         */
        private $conexionDb;

        /**
         * Implementación con singleton
         */
        private static $instance= null;

        /**
         * Funcion para inicializar singleton
         * Si hay más de una instancia borra  la información
         */
        public static function getInstance(){
            if(self::$instance == null){
                self::$instance == new Falta_Asistencia();
            }
            return self::$instance;
        }

        /**
         * Descripción: obtiene todas las faltas de asistencia registradas.
         * Retorna: arreglo con la listas
         */
        public function obtenerListaFaltaAsistencia(){
            try{
                $this->conexionDb = conexion::getInstance();
                $this->objConexion = $this->conexionDb->conectar();
                $sqlQuery = "SELECT * FROM falta_asistencia";
                $sqlResults = $this->objConexion->query($sqlQuery);
                $this->objConexion->desconectar();
                return  $sqlResults;
            }catch(Exception $error){
                echo "Error en clase Falta_Asistencia funcion ObtenerListaFaltaAsistencia," + $error->getMessage();
                return null;
            }
        }

        /**
         * Argumento: id de la asistencia a buscar en la Db
         * Descrpción: busca un id en la tabla Falta_Asistencia y retorna los resultados
         * Retorno: objeto de tipo Falta Asistencia
         */
       public function obtenerFaltaAsistencia($id){
            try{
                $this->conexionDb = conexion::getInstance();
                $this->objConexion = $this->conexionDb->conectar();
                $sqlQuery = "SELECT * FROM falta_asistencia where id= $id";
                $sqlResults = $this->objConexion->query($sqlQuery);
                $this->objConexion->desconectar();
                return  $sqlResults;
            }catch(Exception $error){
                echo "Error en clase Falta_Asistencia funcion ObtenerFaltaAsistencia," + $error->getMessage();
                return null;
            }
        }

        /**
         * Descripción: insetar una nueva Falta asistencia
         * Retorna: true si lo inserta, false si presenta error
         */
      public  function insertarFaltaAsistencia(){
            throw new Exception("Not Implement", 1);            
            try{
                
            }catch (Exception $error){

            }
        }
        /**
         * 
         */
       public function modificarFaltaAsistencia(){
            throw new Exception("Not Implement", 1);            
            try{

            }catch (Exception $error){
                
            }
        }
        /**
         * 
         */
      public  function EliminarFaltaAsistencia(){
            throw new Exception("Not Implement", 1);            
            try{

            }catch (Exception $error){
                
            }
        }
        /**
         * 
         */
      public  function justificadaFaltaAsistencia($id,$Justificada){
            throw new Exception("Not Implement", 1);            
        }

    }
