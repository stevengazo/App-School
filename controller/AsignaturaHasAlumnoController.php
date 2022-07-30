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

    class AsignaturaHasAlumnoController{

        private $Smarty;
        private $NotaModel;
        public static $instance;
        private $AsignaturaModel;
        private $AlumnoModel;
        private $Asignatura_has_AlumnoModel;
    

        public static function getInstancia(){
            if(self::$instance == null){
                self::$instance =new AsignaturaHasAlumnoController();                            
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
                case 'Listar':
                    # code...
                    break;                
                case 'GetBusqueda':
                    # code...
                    break;         
                case 'PostBusqueda':
                    # code...
                    break;                                        
                case 'GetInsertar':
                    # code...
                    break;                                    
                case 'PostInsertar':
                    # code...
                    break;                            
                case 'GetEditar':
                    # code...
                    break;                                    
                case 'PostEditar':
                    # code...
                    break;                            
                case 'GetEliminar':
                    # code...
                    break;                                    
                case 'PostEliminar':
                    # code...
                    break;                            
                            
                default:
                    # code...
                    break;
            }
        }



    }
?>