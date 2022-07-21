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
     */
    require_once 'FaltaAsistenciaController.php';
    class control{
        private $Smarty;
        private $FaltaAsistencia;
        private $Nota;
        private $FaltaAsistenciaController;


        function __construct(){
            $this->Smarty= new config_smarty();
            $this->FaltaAsistencia = Falta_Asistencia::getInstancia();
            $this->Nota = Nota::getInstance();            
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
            $action = "";        
            if(isset($_REQUEST['action'])){ // Compruea que la variable "action" no sea nula
                $action = $_REQUEST['action']; // si no es nula setea la variable acciòn con el valor recibido
            }
            switch ($action) {                    
                case 'ListaFaltaAsistencia':
                    $this->getListaFaltaAsistencia();
                    break;   
                case 'InsertarFaltaAsistencia':
                        $this->getListaFaltaAsistencia();
                        break;  
                case 'verInfoFaltas':
                    $id= $_REQUEST['idFalta'];
                        $this->getInfoFaltaAsistencia($id);
                        break;  
                case 'BorrarFaltas':
                        $id= $_REQUEST['idFalta'];
                        $this->getBorrarFaltaAsistencia($id);
                        break;  
                case 'setBorrarFaltas':
                        $id= $_REQUEST['id'];
                        $this->setBorrarFaltasAsistencia($id);
                        break;                                                  
                case 'InsertarAusencia': // es el mismo metodo perdo con una diferente acciòn y respuesta
                        $this->insertaFaltaAsistencia("get"); // muestra el formulario
                        break;                                                                    
                case 'frmRegistroAusencia':                     
                        $this->insertaFaltaAsistencia("post"); // recibe la informaciòn del formulario
                        break;    
                case 'EditarFaltas':                        
                        $this->getEditarFaltaAsistencia("get");
                    break; 
                case 'EditandoFaltas':                        
                        $this->getEditarFaltaAsistencia("post");
                    break;                                 
                default:                
                    $this->index();
                    break;
            }    
        }



        /**
         * Descripción: envia a la DB el vvalor a borrar y regresa a la lista de asistencias
         */
        function setBorrarFaltasAsistencia($idToDelete){
            $flagResults = $this->FaltaAsistencia->EliminarFaltaAsistencia($idToDelete);
            if($flagResults   ){
                echo "Borrado";
                $this->getListaFaltaAsistencia();
            }
        }


        function getListaFaltaAsistencia(){
            $results = $this->FaltaAsistencia->obtenerListaFaltaAsistencia();
        
            $this->Smarty->setAssign('ListaFaltasAsistencia', $results);
            $this->Smarty->setAssign('titulo', "Lista Ausencias");

            $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
            $this->Smarty->setDisplay("Shared/Head.tpl");       
            $this->Smarty->setDisplay("Shared/NavBar.tpl");       
            $this->Smarty->setDisplay("Falta_Asistencia/Lista_Falta_Asistencia.tpl");
            $this->Smarty->setDisplay("Shared/LayoutClose.tpl");       

        }

        /**
         * Descripción: muestra la ventana para ver el dispositivo.
         */
        function getInfoFaltaAsistencia($id= ''){
            $results = $this->FaltaAsistencia->obtenerFaltaAsistencia($id);
            $this->Smarty->setAssign('ObjetoFaltaAsistencia', $results[0]);

            $this->Smarty->setAssign('titulo', "Ver Falta Asistencia");

            $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
            $this->Smarty->setDisplay("Shared/Head.tpl");       
            $this->Smarty->setDisplay("Shared/NavBar.tpl");       
            $this->Smarty->setDisplay("Falta_Asistencia/Ver_Falta_Asistencia.tpl");
            $this->Smarty->setDisplay("Shared/LayoutClose.tpl");     


        }

        /**
         * Descripción: muestra la ventada para insertar una nueva asistencia
         */
        function insertaFaltaAsistencia($method){
            switch ($method) {
                case "post": // Trabaja con la informaciòn y la mueve a la  DB
                    $id=$_REQUEST['id'];
                    $alumno_id=$_REQUEST['alumno_id'];
                    $asignatura_id=$_REQUEST['asignatura_id'];
                    $fecha=$_REQUEST['fecha'];
                    $justificada=$_REQUEST['justificada'];
                    echo "insertando nueva Ausencia..." ;                    
                    $FlagResult= $this->FaltaAsistencia->insertarFaltaAsistencia($id,$alumno_id,$asignatura_id, $fecha,$justificada);                    
                    if($FlagResult == true){
                        // Vista del elemento generado
                        sleep(2);
                        $this->getInfoFaltaAsistencia($id);
                    }              else{
                        echo "\n error al ingresar usuario";
                    }  
                    break;                                
                case "get": // Recoge informaciòn necesaria y la envia al usuaario para introducir el elemento.
                    $SiguienteId =intval(  $this->FaltaAsistencia->getLastId()) +1; // Trae el ultimo id de la Tabla y le suma uno para el nuevo usuario.
                    $this->Smarty->setAssign('idObjeto', $SiguienteId);
                    
                    $this->Smarty->setAssign('titulo', "Insertar Falta Asistencia");

                    $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
                    $this->Smarty->setDisplay("Shared/Head.tpl");       
                    $this->Smarty->setDisplay("Shared/NavBar.tpl");       
                    $this->Smarty->setDisplay("Falta_Asistencia/Insertar_Falta_Asistencia.tpl");     
                    $this->Smarty->setDisplay("Shared/LayoutClose.tpl");       

                    break;                
                default:
                    echo $method;
                break;
            }
            
        }

        /**
         * Descripción: muestra la ventana para borrar una asistencia
         */
        function  getBorrarFaltaAsistencia($id= ''){
            $results = $this->FaltaAsistencia->obtenerFaltaAsistencia($id);
            $this->Smarty->setAssign('ObjetoFaltaAsistencia', $results[0]);


            $this->Smarty->setAssign('titulo', "Borrar Asistencia");
            $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
            $this->Smarty->setDisplay("Shared/Head.tpl");       
            $this->Smarty->setDisplay("Shared/NavBar.tpl");    
            $this->Smarty->setDisplay("Falta_Asistencia/Borrar_Falta_Asistencia.tpl");
            $this->Smarty->setDisplay("Shared/LayoutClose.tpl");       



        }

        /**
         * Descripción: muestra la ventana para editar una asistencia
         */
        function getEditarFaltaAsistencia($action = "get"){
            $id= $_REQUEST['idFalta'];            
            $results = $this->FaltaAsistencia->obtenerFaltaAsistencia($id);
            if($action == "post"){
                $alumno_id= $_REQUEST['alumno_id'];
                $asignatura_id= $_REQUEST['asignatura_id'];
                $fecha = $_REQUEST['fecha'];
                $justificada = $_REQUEST['justificada'];
                $flagResult = $this->FaltaAsistencia->modificarFaltaAsistencia($id,$alumno_id,$asignatura_id,$fecha,$justificada);
                ECHO $flagResult;
                if($flagResult){
                    $this->getInfoFaltaAsistencia($id);
                }else{
                    $this->getEditarFaltaAsistencia("get");
                }
            }else{
                $this->Smarty->setAssign('ObjetoFaltaAsistencia', $results[0]);                    
                $this->Smarty->setAssign('titulo', "Editar Falta Asistencia");    
                $this->Smarty->setDisplay("Shared/LayoutInit.tpl");       
                $this->Smarty->setDisplay("Shared/Head.tpl");       
                $this->Smarty->setDisplay("Shared/NavBar.tpl");        
                $this->Smarty->setDisplay("Falta_Asistencia/Editar_Falta_Asistencia.tpl");
                $this->Smarty->setDisplay("Shared/LayoutClose.tpl");       
            }
        }        




        
    }
