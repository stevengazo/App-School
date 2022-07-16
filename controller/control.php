<?php
    /**
     * DEPENDENCIAS
     */
    require_once "libs/smarty4_1_1/config_smarty.php";
    require_once "Model/Falta_Asistencia.php";
    require_once "connections/conexion.php";
    require_once "Model/Nota.php";
    class control{
        private $Smarty;
        private $FaltaAsistencia;
        private $Nota;


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
            $this->Smarty->setDisplay("indexControl.php");   
            
        }

        /* 
        * Descripción: Gestiona las peticiones del navegador
        */
        function gestor(){              
            $action = "";
            if(isset($_REQUEST['action'])){
                $action = $_REQUEST['action'];
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
                case 'InsertarAusencia':
                        $this->insertaFaltaAsistencia();
                        break;                                                                    
                default:                
                    $this->index();
                    break;
            }    
        }



        /**
         * Descripción: llama al modelo para obtener todas las asistencias y las renderiza en el navegador
         */
        function getListaFaltaAsistencia(){
            $results = $this->FaltaAsistencia->obtenerListaFaltaAsistencia();
            $this->Smarty->setAssign('ListaFaltasAsistencia', $results);
            $this->Smarty->setDisplay("Falta_Asistencia/Lista_Falta_Asistencia.tpl");
        }

        function getInfoFaltaAsistencia($id= ''){
            $results = $this->FaltaAsistencia->obtenerFaltaAsistencia($id);
            $this->Smarty->setAssign('ObjetoFaltaAsistencia', $results[0]);
            $this->Smarty->setDisplay("Falta_Asistencia/Ver_Falta_Asistencia.tpl");
        }

        function insertaFaltaAsistencia(){
            $SiguienteId =intval(  $this->FaltaAsistencia->getLastId()) +1;
            $this->Smarty->setAssign('idObjeto', $SiguienteId);
            $this->Smarty->setDisplay("Falta_Asistencia/Insertar_Falta_Asistencia.tpl");
        }
    }
?>