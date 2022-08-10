<?php
 session_start();
    /**
     * DEPENDENCIAS
     */
    require_once "libs/smarty4_1_1/config_smarty.php";
    require_once "Model/Falta_Asistencia.php";
    require_once "connections/conexion.php";
    require_once "Model/Nota.php";
    require_once "Model/Profesor.php";    



    class control{
        /**
         * vARIABLES INTERNAS DE LA CLASE
         */
        private $Smarty;
        private $Profesor;

        
        /**
         * Funcion constructora
         */
        function __construct(){
            $this->Smarty= new config_smarty();
            $this->Profesor = Profesor::getInstance();
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
            $this->Smarty->setAssign("titulo", "Sistema Academico");
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
                $this->validarInactividad();
             }else {
                 $this->Smarty->setAssign("titulo","Login");
                 $this->Smarty->setAssign("msg","");
                $this->Smarty->setDisplay("login.tpl");
                }
              }else{
                $action = $_REQUEST['action'];   
                $this->validarInactividad();
               switch ($action) {
                 case "login":
                       $this->procesar_login(0);
                       break;
                  case "index":
                     $this->index();
                     break;
                  case "cerrar_sesion":
                    $this->cerrar_sesion();
                    break;                              
                  //default:
                      //$this->index();
                      //break;
                 }
               }              
        }  
        

        function cerrar_sesion(){
          //Removemos sesión.
          session_unset();
          //Destruimos sesión.
          session_destroy();
           //Redirigimos pagina.
          header("Location: index.php");    
        }        

        /**
         * Procesa el login del usuario
         * Verifica que la contraseña este en la DB de administrador
         */
        function procesar_login($status=0){
            $usu  = $_REQUEST['txtUsuario'];
            $pass = $_REQUEST['txtpass'];
            $rs = $this->Profesor->val_login($usu,$pass);
            $flag = 0;
            $rol = 0;
            while($fila = $rs->fetch_assoc()){              
              $id = $fila['id'];
              $flag = 1;
              $status = 1;
            }
            if($flag == 1){              
              $_SESSION['USUARIO'] = $usu;
              $_SESSION['ID']     = $id;    
              $this->index();
            }else{                
                $this->Smarty->setAssign("msg","Credenciales Incorrectas");               
                $this->Smarty->setDisplay("login.tpl");
            }
        } 
            
        function validarInactividad(){
          //Comprobamos si esta definida la sesión 'tiempo'.
          if(isset($_SESSION['tiempo']) ) {
        
              //Tiempo en segundos para dar vida a la sesión.
              $inactivo = 1800;//30min en este caso.
        
              //Calculamos tiempo de vida inactivo.
              $vida_session = time() - $_SESSION['tiempo'];
        
                  //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
                  if($vida_session > $inactivo)
                  {
                      //Removemos sesión.
                      session_unset();
                      //Destruimos sesión.
                      session_destroy();
                      //Redirigimos pagina.
                      header("Location: index.php");
        
                      exit();
                  } else {  // si no ha caducado la sesion, actualizamos
                      $_SESSION['tiempo'] = time();
                  }
        
        
          } else {
              //Activamos sesion tiempo.
              $_SESSION['tiempo'] = time();
          }        
    }
  }
