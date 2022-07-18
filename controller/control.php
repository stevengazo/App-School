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
                case 'InsertarAusencia': // es el mismo metodo perdo con una diferente acciòn y respuesta
                        $this->insertaFaltaAsistencia("get"); // muestra el formulario
                        break;                                                                    
                case 'frmRegistroAusencia':                     
                    $this->insertaFaltaAsistencia("post"); // recibe la informaciòn del formulario
                    break;    
                case 'EditarFaltas':
                    $id= $_REQUEST['idFalta'];
                    $this->getEditarFaltaAsistencia($id);
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

        /**
         * Descripción: muestra la ventana para ver el dispositivo.
         */
        function getInfoFaltaAsistencia($id= ''){
            $results = $this->FaltaAsistencia->obtenerFaltaAsistencia($id);
            $this->Smarty->setAssign('ObjetoFaltaAsistencia', $results[0]);
            $this->Smarty->setDisplay("Falta_Asistencia/Ver_Falta_Asistencia.tpl");
        }

        /**
         * Descripción: muestra la ventada para insertar una nueva asistencia
         */
        function insertaFaltaAsistencia($method){
            echo $method;         
            switch ($method) {
                case "post": // Trabaja con la informaciòn y la mueve a la  DB
                    echo $method;
                    echo "falta asistencia post - inserciòn dei nformaciòn";                    
                    break;                                
                case "get": // Recoge informaciòn necesaria y la envia al usuaario para introducir el elemento.
                    $SiguienteId =intval(  $this->FaltaAsistencia->getLastId()) +1; // Trae el ultimo id de la Tabla y le suma uno para el nuevo usuario.
                    $this->Smarty->setAssign('idObjeto', $SiguienteId);
                    $this->Smarty->setDisplay("Falta_Asistencia/Insertar_Falta_Asistencia.tpl");
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
            $this->Smarty->setDisplay("Falta_Asistencia/Borrar_Falta_Asistencia.tpl");
        }

        /**
         * Descripción: muestra la ventana para editar una asistencia
         */
        function getEditarFaltaAsistencia($id= ''){
            $results = $this->FaltaAsistencia->obtenerFaltaAsistencia($id);
            $this->Smarty->setAssign('ObjetoFaltaAsistencia', $results[0]);
            $this->Smarty->setDisplay("Falta_Asistencia/Editar_Falta_Asistencia.tpl");
        }

        
    }
