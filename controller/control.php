<?php
    /**
     * DEPENDENCIAS
     */
    require_once "libs/smarty4_1_1/config_smarty.php";
    require_once "Model/Falta_Asistencia.php";
    require_once "connections/conexion.php";
    require_once "Model/Nota.php";
    require_once "controller/NotasController.php";
    /**
     * Controladores
     */
    require_once 'FaltaAsistenciaController.php';
    class control{
        private $Smarty;
        private $FaltaAsistencia;
        private $Nota;
        private $FaltaAsistenciaController;
        private $NotasController;


        function __construct(){
            $this->Smarty= new config_smarty();
            $this->FaltaAsistencia = Falta_Asistencia::getInstancia();
            $this->Nota = Nota::getInstance();    
            $this->NotasController = NotasController::getInstancia(); 
            $this->FaltaAsistenciaController = FaltaAsistenciaController::getInstancia();       
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
            // llamada a la interfaz    
            $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
            $this->Smarty->setDisplay("Shared/Head.tpl");       
            $this->Smarty->setDisplay("Shared/NavBar.tpl");       
            $this->Smarty->setDisplay("Shared/LayoutClose.tpl");                      
        }

        /* 
        * Descripción: Gestiona las peticiones del navegador
        */
        function gestor(){       
            $Controller= "";                               
            $action = "";        
            if(isset($_REQUEST['action'])){ // Compruea que la variable "action" no sea nula
                $action = $_REQUEST['action']; // si no es nula setea la variable acciòn con el valor recibido
            }
            if(isset($_REQUEST['Controller'])){ // Compruea que la variable "action" no sea nula
                $Controller = $_REQUEST['Controller']; // si no es nula setea la variable acciòn con el valor recibido
            }
            echo $Controller;
            switch ($Controller) {
                case 'Notas':
                    $this->NotasController->Gestor($action);
                    break;   
                case 'FaltaAsistencia':
                        $this->FaltaAsistenciaController->Gestor($action);
                        break;                                    
                default:     
                    $this->index();
                    break;
            }
        }   
    }
?>