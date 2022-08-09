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
            if(!isset($_REQUEST['action'])){

                if(isset($_SESSION['USUARIO'])){
                  $this->index();
                       //$this->validarInactividad();
               }else {
                   $this->Smarty->setAssign("titulo","Login");
                 //  $this->smarty->setAssign("msg","");
                  $this->Smarty->setDisplay("login.tpl");
                  }
                }else{
                  $action = $_REQUEST['action'];   
                 //  $this->validarInactividad();
                 switch ($action) {
                   case "login":
                         $this->procesar_login();
                         break;
                    case "index":
                       $this->index();
                       break;
                    //default:
                        //$this->index();
                        //break;
                   }
                 }
        }  
        

        /**
         * Procesa el login del usuario
         * Verifica que la contraseña este en la DB de administrador
         */
        function procesar_login(){
            $usu  = $_REQUEST['txtUsuario'];
            $pass = $_REQUEST['txtpass'];
            $rs = $this->Profesor->val_login($usu,$pass);
            $flag = 0;
            $rol = 0;
            while($fila = $rs->fetch_assoc()){
              //echo "Nombre: ".$fila['nombre'];
              $id = $fila['id'];
              $flag = 1;
            }
            if($flag == 1){
    
              $_SESSION['USUARIO'] = $usu;
              $_SESSION['ID']     = $id;
    
              $this->index();
            }else{
                //$this->smarty->setAssign("msg","Error usuario o password errores");
                $this->smarty->setDisplay("login.tpl");
            }
        }        
    }
?>