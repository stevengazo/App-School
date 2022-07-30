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

    class NotasController{

        private $Smarty;
        private $NotaModel;
        public static $instance;
        private $AsignaturaModel;
        private $AlumnoModel;
        private $Asignatura_has_AlumnoModel;
    

        public static function getInstancia(){
            if(self::$instance == null){
                self::$instance =new NotasController();                            
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
        
        function Gestor($accion){

            switch ($accion) {
                case "listaNotas":
                    $this->listaNotas();
                    break;
                case "CrearNota":
                    $this->getInsertarNota("get");
                    break;
                case "frmInsertarNota":

                    $this->getInsertarNota("post");
                    break;                    
                case "VerNota":
                    $id = $_REQUEST['idNota'];
                    $this->VerNota($id);
                    break;                         
                case "EditarNotaGet":
                    $id = $_REQUEST['idNota'];
                    $this->EditarNota($id, "get");
                    break;
                case "frmEditarNota":
                        $id = $_REQUEST['id'];
                        $this->EditarNota($id, "post");                    
                        break;        
                case "EliminarNota":
                    $id = $_REQUEST['idNota'];
                    $this->EliminarNota($id, "get");                    
                    break;
                case "EliminarNotaPost":
                        $id = $_REQUEST['idNota'];
                        $this->EliminarNota($id, "post");                    
                        break;                    
            default:
                    break;
            }
        }


        function  EliminarNota($id,$metodo){
            if($metodo=="get"){
                $Result = $this->NotaModel->obtenerNotaPorId($id);
                $this->Smarty->setAssign("NotaObjecto", $Result[0]);            
                $this->Smarty->setAssign("titulo", "Información Nota");            
                $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
                $this->Smarty->setDisplay("Shared/Head.tpl");       
                $this->Smarty->setDisplay("Shared/NavBar.tpl");       
                $this->Smarty->setDisplay("Notas/Eliminar_nota.tpl");     
                $this->Smarty->setDisplay("Shared/LayoutClose.tpl");
            }else if($metodo== "post"){
                echo "post delete note";
                $flagResult = $this->NotaModel->borrarNota($id);
                if($flagResult){
                    $results = $this->NotaModel->obtenerListaNotas();

                    $this->Smarty->setAssign("ListaNotas",$results);
                    $this->Smarty->setAssign("titulo", "Lista de Notas");
        
                    $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
                    $this->Smarty->setDisplay("Shared/Head.tpl");       
                    $this->Smarty->setDisplay("Shared/NavBar.tpl");       
                    $this->Smarty->setDisplay("Notas/ListaNotas.tpl");     
                    $this->Smarty->setDisplay("Shared/LayoutClose.tpl");       
                }else{
                    echo "post delete note";
                }
            }
            
        }

        /**
         * Permite ver una nota en especifico
         */
        function VerNota($id){
            $Result = $this->NotaModel->obtenerNotaPorId($id);
            $this->Smarty->setAssign("NotaObjecto", $Result[0]);
            $this->Smarty->setAssign("titulo", "Información Nota");            
            $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
            $this->Smarty->setDisplay("Shared/Head.tpl");       
            $this->Smarty->setDisplay("Shared/NavBar.tpl");       
            $this->Smarty->setDisplay("Notas/Ver_Nota.tpl");     
            $this->Smarty->setDisplay("Shared/LayoutClose.tpl");                   
        }

        function EditarNota($id, $metodo){
            if($metodo == "get"){
                $listAsigAlum = $this->Asignatura_has_AlumnoModel->getArregloAsigAlum();                              
                $this->Smarty->setAssign("ListAsigAlum",  $listAsigAlum);
                $tmpObjet = $this->NotaModel->obtenerNotaPorId($id);
                $this->Smarty->setAssign("titulo", "Editar Nota");
                $this->Smarty->setAssign("ObjetoNota", $tmpObjet[0]);
                $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
                $this->Smarty->setDisplay("Shared/Head.tpl");       
                $this->Smarty->setDisplay("Shared/NavBar.tpl");       
                $this->Smarty->setDisplay("Notas/Editar_Nota.tpl");     
                $this->Smarty->setDisplay("Shared/LayoutClose.tpl");                       
            }else if($metodo=="post"){
                echo "metodo".$metodo;
                $tmpObjet = $this->NotaModel->obtenerNotaPorId($id);
                $tmpObjet = $tmpObjet[0];                
                $trimestreTmp = $_REQUEST['trimestre'];                
                $notaTmp = $_REQUEST['nota'];                
                $notaTmp = $_REQUEST['nota'];
                $asigAlumTmp = $_REQUEST['asignatura_has_alumno_id'];
                $flagResult = $this->NotaModel->UpdateNota($id,$asigAlumTmp,$notaTmp,$trimestreTmp);
                if($flagResult){
                    $Result = $this->NotaModel->obtenerNotaPorId($id);
                    $this->Smarty->setAssign("NotaObjecto", $Result[0]);
                    $this->Smarty->setAssign("titulo", "Información Nota");            
                    $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
                    $this->Smarty->setDisplay("Shared/Head.tpl");       
                    $this->Smarty->setDisplay("Shared/NavBar.tpl");       
                    $this->Smarty->setDisplay("Notas/Ver_Nota.tpl");     
                    $this->Smarty->setDisplay("Shared/LayoutClose.tpl");                   
                }   else{
                    echo "error.. no se modifico la nota";

                    
                }             

                
          
          }
        }

        /**
         * Gestiona la inserción de una nueva nota 
         * Usa un get y post para mostrar y obtener información
         */
        function getInsertarNota($method){
            if($method == "post"){
                // Post

               $id = $_REQUEST['id'];
                $asignatura_has_alumno_id = $_REQUEST['asignatura_has_alumno_id'];
                $trimestre = $_REQUEST['trimestre'];
                $nota = $_REQUEST['nota'];
                $flag= $this->NotaModel->insertaNota($id,$asignatura_has_alumno_id, $trimestre,$nota);
                if($flag){
                    $this->VerNota($id);
                }else{
                    echo "error al ingresar";
                }

            }else{
                // Get
                $listaAlumnos = $this->AlumnoModel->obtenerArregloAlumnosSimple();
                $listaAsignaturas = $this->AsignaturaModel->obtenerArregloAsignaturaSimple();
                $listAsigAlum = $this->Asignatura_has_AlumnoModel->getArregloAsigAlum();
                $id=  $this->NotaModel->getUltimoId() + 1;
                $this->Smarty->setAssign("ListAsigAlum",  $listAsigAlum);
                $this->Smarty->setAssign("listaAlumnos", $listaAlumnos);
                $this->Smarty->setAssign("listaAsignatura", $listaAsignaturas);
                
                $this->Smarty->setAssign("titulo", "Crear Nota");
                $this->Smarty->setAssign("NuevoId", $id);
                $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
                $this->Smarty->setDisplay("Shared/Head.tpl");       
                $this->Smarty->setDisplay("Shared/NavBar.tpl");       
                $this->Smarty->setDisplay("Notas/Insertar_Nota.tpl");     
                $this->Smarty->setDisplay("Shared/LayoutClose.tpl");       
            }

        }


        /**
         * Descripción: trae la lista de notas completa
         */
        function listaNotas(){
            $results = $this->NotaModel->obtenerListaNotas();

            $this->Smarty->setAssign("ListaNotas",$results);
            $this->Smarty->setAssign("titulo", "Lista de Notas");

            $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
            $this->Smarty->setDisplay("Shared/Head.tpl");       
            $this->Smarty->setDisplay("Shared/NavBar.tpl");       
            $this->Smarty->setDisplay("Notas/ListaNotas.tpl");     
            $this->Smarty->setDisplay("Shared/LayoutClose.tpl");       
        }

    }
