<?php
     /**
     * DEPENDENCIAS
     */
    require_once "libs/smarty4_1_1/config_smarty.php";
    require_once "Model/Falta_Asistencia.php";
    require_once "Model/Asignatura.php";
    require_once "connections/conexion.php";
    require_once "Model/Nota.php";
    require_once "Model/Asignatura_has_Alumno.php";

    class NivelController{

        private $Smarty;
        private $NotaModel;
        public static $instance;
        private $AsignaturaModel;
        private $AlumnoModel;
        private $Asignatura_has_AlumnoModel;
    

        public static function getInstancia(){
            if(self::$instance == null){
                self::$instance =new NivelController();                            
            }
            return self::$instance;
        }

        function __construct()
        {
            $this->Smarty= new config_smarty();
            $this->NotaModel = Nota::getInstancia();
            $this->AsignaturaModel = Asignatura::getInstancia();
            $this->AlumnoModel= Alumno::getInstancia();
            $this->Asignatura_has_AlumnoModel= Asignatura_has_Alumno::getInstancia();
        }

        /**
         * Encargado de gestionar el accion recibido de Control 
         * y realizar una tarea en concreto
         */
        function Gestor($accion){
            switch ($accion) {
                case 'Value':
                   #code
                    break;                                                
                default:
                    // Seteo y envio de datos a la interfaz
                    $this->Smarty->setAssign("saludo","Inicio del proyecto");
                    $this->Smarty->setAssign("titulo", "Home");
                    // llamada a la interfaz    
                    $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
                    $this->Smarty->setDisplay("Shared/Head.tpl");       
                    $this->Smarty->setDisplay("Shared/NavBar.tpl");       
                    $this->Smarty->setDisplay("Shared/LayoutClose.tpl");                      
                    break;
            }
        }

    }
?>