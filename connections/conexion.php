<?php
    // clase para la conexión a la DB 
    class conexion{
        /* Atributos de la clase */

        //Nombre del servidor
        private $host;
        // Nombre de la base de datos
        private $dbName;
        // Nombre del usuario de la DB
        private $usuario;
        // Contraseña de la DB
        private $contrasena;
        // Cadena de conexión
        private $conn;
        
        /*
            funcion constructora de la clase
        */
        function __construct()
        {
            $this->host = "localhost";
            $this->dbName = "testingdb";
            $this->usuario = "root";
            $this->contrasena = "";
        }

        /* 
            Instancia de la clase para uso de singleton
        */
     /*  public static $instance = null;
        /*
            Funcion estatica para implementacion Singleton
        
        public static function getInstance(){
            if(self::$instance == null){
                self::$instance == new conexion();
            }
            return self::$instance;
        }
        */
        /**
         * Funcion para conectar con la DB
         */
         function conectar(){
            $this->conn = mysqli_connect($this->host,$this->usuario,$this->contrasena,$this->dbName);
            if(!$this->conn){
                echo "Error, no se conecto a la DB"  +  $this->host + $this->dbName;            
                exit;
            }else{
                //echo "conectado a la DB";
                return $this->conn;
            }            
         }

         /**
          * Funcion para cerrar la conexión a la base de datos
          */
          function desconectar(){
            mysqli_close($this->conn);
          }
    }
?>