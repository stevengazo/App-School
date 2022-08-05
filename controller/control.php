<?php
    /**
     * DEPENDENCIAS
     */
    require_once "libs/smarty4_1_1/config_smarty.php";
    require_once "Model/Falta_Asistencia.php";
    require_once "connections/conexion.php";
    require_once "Model/Nota.php";

    /**
     * Controladores
     * Cuando "control" es invocado, este recibe un controlador y le 
     * envia la acción a este.
     */
    
    require_once "controller/AdministradorController.php";
    require_once "controller/AlumnoController.php";
    require_once "controller/AsignaturaController.php";    
    require_once "controller/AsignaturaHasAlumnoController.php";
    require_once "controller/FaltaAsistenciaController.php";
    require_once "controller/HorariosController.php";    
    require_once "controller/NivelController.php";
    require_once "controller/NotasController.php";
    require_once "controller/ProfesorController.php";

    /**
     * Controladores
     */
    require_once 'FaltaAsistenciaController.php';
    class control{
        /**
         * vARIABLES INTERNAS DE LA CLASE
         */
        private $Smarty;

        private $AdministradorController;
        private $AlumnoController;
        private $AsignaturaController;
        private $AsignaturaHasAlumnoController;
        private $FaltaAsistenciaController;
        private $HorariosController;
        private $NivelController;
        private $NotasController;
        private $ProfesorController;

        private $FaltaAsistencia;
        private $Nota;
        
        
    


        /**
         * Funcion constructora
         */
        function __construct(){
            $this->Smarty= new config_smarty();
            $this->FaltaAsistencia = Falta_Asistencia::getInstancia();
            $this->Nota = Nota::getInstancia();    
            $this->NotasController = NotasController::getInstancia(); 
            $this->FaltaAsistenciaController = FaltaAsistenciaController::getInstancia();       
            $this->AsignaturaHasAlumnoController = AsignaturaHasAlumnoController::getInstancia();

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
            $Controller= "";                               
            $action = "";        
            if(isset($_REQUEST['action'])){ // Compruea que la variable "action" no sea nula
                $action = $_REQUEST['action']; // si no es nula setea la variable acciòn con el valor recibido
            }
            if(isset($_REQUEST['Controller'])){ // Compruea que la variable "action" no sea nula
                $Controller = $_REQUEST['Controller']; // si no es nula setea la variable acciòn con el valor recibido
            }
            switch ($Controller) {
                case 'Notas':
                    $this->NotasController->Gestor($action);
                    break;   
                    case 'Profesor':
                        $this->ProfesorController->Gestor($action);
                        break;                       
                case 'FaltaAsistencia':
                        $this->FaltaAsistenciaController->Gestor($action);
                        break;                                    
                case 'AsignaturaHasAlumno':
                    $this->AsignaturaHasAlumnoController->Gestor($action);
                    break;                                                            
                default:     
                    $this->index();
                    break;
            }
        }   
    }
?>