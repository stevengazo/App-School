<?php
    /**
     * DEPENDENCIAS
     */
    require_once "./libs/smarty4_1_1/config_smarty.php";
    require_once './Model/Falta_Asistencia.php';
    require_once './Model/Nota.php';
    class control{
        private $Smarty;
        private $FaltaAsistencia;
        private $Nota;


        function __construct(){
            $this->Smarty= new config_smarty();
            $this->FaltaAsistencia = Falta_Asistencia::getInstance();
            $this->Nota = Nota::getInstance();
        }

        /**
         * Implementación de singleton
         */
        private static $instance = null;
        public static function getInstance(){
            if(self::$instance ==null){
                self::$instance = new control();                
            }
            return self::$instance;
        }


        /**
         * funcion index
         */
        function index(){
            // Seteo y envio de datos a la interfaz
            $this->Smarty->setAssign("saludo","Inicio del proyecto");
            // llamada a la interfaz    
            $this->Smarty->setDisplay("indexControl.php");            
        }
    }
?>