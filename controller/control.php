<?php
    /**
     * DEPENDENCIAS
     */
    require_once "libs/smarty4_1_1/config_smarty.php";
    require_once "Model/Falta_Asistencia.php";
    require_once "connections/conexion.php";
    require_once "Model/Nota.php";


    class control{
        /**
         * vARIABLES INTERNAS DE LA CLASE
         */
        private $Smarty;

        
        /**
         * Funcion constructora
         */
        function __construct(){
            $this->Smarty= new config_smarty();
        }

        /**
         * Implementación de singleton
         */
        private static $instance = null;
        public static function getInstancia(){
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
            $this->Smarty->setAssign("titulo", "Home");
            // llamada a la interfaz    
            $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
            $this->Smarty->setDisplay("Shared/Head.tpl");       
            $this->Smarty->setDisplay("Shared/NavBar.tpl");   
            $this->Smarty->setDisplay("Shared/body.tpl");   
            $this->Smarty->setDisplay("Shared/LayoutClose.tpl");                      
        }

        /* 
        * Descripción: Gestiona las peticiones del navegador, recibe un parametro controller y redirecciona al controlador especificado
        */
        function gestor(){       

            $action = "";        
            if(isset($_REQUEST['action'])){ // Compruea que la variable "action" no sea nula
                $action = $_REQUEST['action']; // si no es nula setea la variable acciòn con el valor recibido
            }
            switch ($action) {      
                case 'index':
                    $this->index();
                    break;                                                            
                default:     
                    $this->index();
                    break;
            }
        }   
    }
?>