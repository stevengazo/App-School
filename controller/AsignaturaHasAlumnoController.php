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
                   $this->Listar();
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
                    $this->GetInsertar();
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


    function GetInsertar(){
       $ArregloAlumnos = $this->AlumnoModel->obtenerArregloAlumnosSimple();
       $ArregloAsignaturas =  $this->AsignaturaModel->obtenerArregloAsignaturaSimple();
       $Id =  $this->Asignatura_has_AlumnoModel->getUltimoId()+1;

       $this->Smarty->setAssign("id",$Id);
       $this->Smarty->setAssign("arregloAlumnos", $ArregloAlumnos);
       $this->Smarty->setAssign("ArregloAsignaturas", $ArregloAsignaturas);
       $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
       $this->Smarty->setDisplay("Shared/Head.tpl");       
       $this->Smarty->setDisplay("Shared/NavBar.tpl");       
       $this->Smarty->setDisplay("Asignatura_has_alumno/Insertar_Asig_has_Alum.tpl");     
       $this->Smarty->setDisplay("Shared/LayoutClose.tpl");              


    }


    function Listar(){
        $ArrayAsigHasAlumn = $this->Asignatura_has_AlumnoModel->getArregloAsigAlum();

        $this->Smarty->setAssign("ArreglosObjetos", $ArrayAsigHasAlumn);
        $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
        $this->Smarty->setDisplay("Shared/Head.tpl");       
        $this->Smarty->setDisplay("Shared/NavBar.tpl");       
        $this->Smarty->setDisplay("Asignatura_has_alumno/Listar_Asig_has_alumno.tpl");     
        $this->Smarty->setDisplay("Shared/LayoutClose.tpl");       
    }


    }
?>