<?php
session_start();
setcookie("myCookie", false);
/**
 * DEPENDENCIAS
 */
require_once "libs/smarty4_1_1/config_smarty.php";
require_once "Model/Falta_Asistencia.php";
require_once "connections/conexion.php";
require_once "Model/Nota.php";
require_once "Model/Profesor.php";
require_once "Model/Alumno.php";
require_once "Model/Administrador.php";
require_once "Model/Asignatura.php";
require_once "Model/Padre.php";
require_once "Model/Nivel.php";

class control
{
  /**
   * vARIABLES INTERNAS DE LA CLASE
   */
  private $Padre;
  private $Smarty;
  private $Profesor;
  private $Alumno;
  private $Asignatura;
  private $Nivel;
  private $AdministradorModel;

  /**
   * Funcion constructora
   */
  function __construct()
  {
    $this->Smarty = new config_smarty();
    $this->Profesor = Profesor::getInstance();
    $this->Alumno = new Alumno();
    $this->Asignatura = new Asignatura();
    $this->Nivel = new Nivel();
    $this->AdministradorModel = Administrador::getInstancia();
    $this->Padre= Padre::getInstance();
  }

  /**
   * Implementación de singleton
   */
  private static $instance = null;
  public static function getInstancia()
  {
    if (self::$instance == null) {
      self::$instance = new control();
    }
    return self::$instance;
  }


  /**
   * funcion index
   */
  function index($tipoUsuario)
  {
    /**
     * Define un dato en el cliente que permita identificar si el usuario
     * puede modificar o solo leer datos
     */
    $LocalStorageScript = '
      <script>
        sessionStorage.setItem("tipoUsuario", "'.$tipoUsuario.'"); 
        sessionStorage.setItem("editable", '.$_SESSION['isEditable'].');
        sessionStorage.setItem("idUser", '.$_SESSION['ID'].' );
      </script>         
    ';
    $this->Smarty->setAssign("scriptStorage", $LocalStorageScript);

    $this->Smarty->setAssign("editable",$_SESSION['isEditable']);

    $this->Smarty->setAssign("saludo", "Inicio del proyecto");
    $this->Smarty->setAssign("titulo", "Sistema Academico");
    // llamada a la interfaz
    $this->Smarty->setDisplay("Shared/LayoutInit.tpl");
    $this->Smarty->setDisplay("Shared/Head.tpl");


    switch ($_SESSION['tipoUsuario']) {
      case 'Alumno':
        $this->Smarty->setDisplay("Shared/NavBarAlumno.tpl");
        break;
      case 'Administrador':
        $this->Smarty->setDisplay("Shared/NavBarAdministrador.tpl");
        break;
      case 'Profesor':
        $this->Smarty->setDisplay("Shared/NavBarProfesor.tpl");
        break;
      case 'Padre':
        $this->Smarty->setDisplay("Shared/NavBarPadre.tpl");
        break;
      default:
        $this->Smarty->setDisplay("Shared/NavBarDefault.tpl");
        break;
    }
    $this->Smarty->setDisplay("Shared/body.tpl");
    $this->Smarty->setDisplay("Shared/LayoutClose.tpl");
  }

  /*
  * Descripción: Gestiona las peticiones del navegador, recibe un parametro controller y redirecciona al controlador especificado
  */
  function gestor()
  {
    
    $this->validarInactividad();    
    # Comprueba que el "Action" este seteado
    if (!isset($_REQUEST['action'])  ) {
      if (isset($_SESSION['USUARIO'])) {
        $this->index($_SESSION['tipoUsuario']);
        $this->validarInactividad();
      } else {
        $this->Smarty->setAssign("titulo", "Login");
        $this->Smarty->setAssign("msg", "");
        $this->Smarty->setDisplay("login.tpl");
      }
    } else {
      $action = $_REQUEST['action'];
      $this->validarInactividad();
        switch ($action) {
          case "login":
            $this->procesar_login();
            break;
          case "index":
            $this->index($_SESSION['tipoUsuario']);
            break;
          case "cerrar_sesion":
            $this->cerrar_sesion();
            break;
          case "abrir_profe":
            $this->frm_profe();
            break;
          case "frmRegistroProfesor":
            $this->guardar_nuevo_profesor();
            break;
          case "abrir_alumno":
            $this->frm_alumno();
            break;
          case "frmRegistroAlumno":
            $this->guardar_nuevo_alumno();
            break;
          case "abrir_asig":
            $this->frm_asig();
            break;
          case "frmRegistroAsignatura":
            $this->guardar_nueva_asignatura();
            break;
          case "abrir_nivel":
            $this->frm_nivel();
            break;
          case "frmRegistroNivel":
            $this->guardar_nuevo_nivel();
            break;
            default:
            $this->Smarty->setAssign("msg", "");
            $this->Smarty->setDisplay("login.tpl");
            break;      
      }      
    }
  }


  function cerrar_sesion()
  {
    $LocalStorageScript = '
      storage.removeItem("tipoUsuario");    
    ';

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
  function procesar_login()
  {
    $flag = 0;
    # recupera los datos basicos
    $usu  = $_REQUEST['txtUsuario'];
    $pass = $_REQUEST['txtpass'];
    $tipoUsuario = $_REQUEST['tipoUsuario'];

    switch ($tipoUsuario) {
      case 'Alumno':
        $_SESSION['isEditable']="false";
        #valida el inicio de sesión de alumno
        $rs = $this->Alumno->val_login($usu, $pass);
        $flag = 0;
        $rol = 0;
        # Recorre los resultados del Model
        while ($fila = $rs->fetch_assoc()) {
          $id = $fila['id'];
          $flag = 1;
          $status = 1;
        }
        break;
      case 'Padre':
        $_SESSION['isEditable']="false";
        #valida el inicio de sesión de padre
        $rs = $this->Padre->val_login($usu, $pass);
        $flag = 0;
        $rol = 0;
        # Recorre los resultados del Model
        while ($fila = $rs->fetch_assoc()) {
          $id = $fila['id'];
          $flag = 1;
          $status = 1;
        }
        break;
      case 'Profesor':
        $_SESSION['isEditable']="true";
        #valida el inicio de sesión de profesor
        $rs = $this->Profesor->val_login($usu, $pass);
        $flag = 0;
        $rol = 0;
        # Recorre los resultados del Model
        while ($fila = $rs->fetch_assoc()) {
          $id = $fila['id'];
          $flag = 1;
          $status = 1;
        }
        break;
      case 'Administrador':
        $_SESSION['isEditable']="true";
        #valida el inicio de sesión de administrador
        $rs = $this->AdministradorModel->val_login($usu, $pass);
        $flag = 0;
        $rol = 0;
        # Recorre los resultados del Model
        while ($fila = $rs->fetch_assoc()) {
          $id = $fila['id'];
          $flag = 1;
          $status = 1;
        }
        break;
      default:
        # Si es falsa vuelve al login
        $this->Smarty->setAssign("msg", "tipo de usuario no especificado");
        $this->Smarty->setDisplay("login.tpl");
        break;
    }
    # Si la bandera es verdadera inicia sesión
    if ($flag == 1) {
      $_SESSION['USUARIO'] = $usu;
      $_SESSION['ID']     = $id;
      $_SESSION['tipoUsuario'] = $tipoUsuario;      
      $this->index($tipoUsuario);
    } else {
      # Si es falsa vuelve al login
      $this->Smarty->setAssign("msg", "Credenciales Incorrectas");
      $this->Smarty->setDisplay("login.tpl");
    }
  }

  function validarInactividad()
  {
    //Comprobamos si esta definida la sesión 'tiempo'.
    if (isset($_SESSION['tiempo'])) {

      //Tiempo en segundos para dar vida a la sesión.
      $inactivo = 1800; //30min en este caso.

      //Calculamos tiempo de vida inactivo.
      $vida_session = time() - $_SESSION['tiempo'];

      //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
      if ($vida_session > $inactivo) {
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

  function frm_profe()
  {
    $this->Smarty->setAssign("titulo", "Sistema Academico");
    $LocalStorageScript = '
      <script>
        sessionStorage.setItem("tipoUsuario", "'.$_SESSION['tipoUsuario'].'"); 
        sessionStorage.setItem("editable", '.$_SESSION['isEditable'].');
        sessionStorage.setItem("idUser", '.$_SESSION['ID'].' );
      </script>         
    ';
    $this->Smarty->setAssign("scriptStorage", $LocalStorageScript);
    
    $this->Smarty->setDisplay("Shared/LayoutInit.tpl");
    $this->Smarty->setDisplay("Shared/Head.tpl");
    switch ($_SESSION['tipoUsuario']) {
      case 'Alumno':
        $this->Smarty->setDisplay("Shared/NavBarAlumno.tpl");
        break;
      case 'Administrador':
        $this->Smarty->setDisplay("Shared/NavBarAdministrador.tpl");
        break;
      case 'Profesor':
        $this->Smarty->setDisplay("Shared/NavBarProfesor.tpl");
        break;
      case 'Padre':
        $this->Smarty->setDisplay("Shared/NavBarPadre.tpl");
        break;
      default:
        $this->Smarty->setDisplay("Shared/NavBarDefault.tpl");
        break;
    }
    $this->Smarty->setDisplay("profesores/Insertar_Profesor.tpl");
    $this->Smarty->setDisplay("Shared/LayoutClose.tpl");
  }

  function frm_alumno()
  {
    $this->Smarty->setAssign("titulo", "Sistema Academico");
    $LocalStorageScript = '
      <script>
        sessionStorage.setItem("tipoUsuario", "'.$_SESSION['tipoUsuario'].'"); 
        sessionStorage.setItem("editable", '.$_SESSION['isEditable'].');
        sessionStorage.setItem("idUser", '.$_SESSION['ID'].' );
      </script>         
    ';
    $this->Smarty->setAssign("scriptStorage", $LocalStorageScript);


    $this->Smarty->setDisplay("Shared/LayoutInit.tpl");
    $this->Smarty->setDisplay("Shared/Head.tpl");  
    switch ($_SESSION['tipoUsuario']) {
      case 'Alumno':
        $this->Smarty->setDisplay("Shared/NavBarAlumno.tpl");
        break;
      case 'Administrador':
        $this->Smarty->setDisplay("Shared/NavBarAdministrador.tpl");
        break;
      case 'Profesor':
        $this->Smarty->setDisplay("Shared/NavBarProfesor.tpl");
        break;
      case 'Padre':
        $this->Smarty->setDisplay("Shared/NavBarPadre.tpl");
        break;
      default:
        $this->Smarty->setDisplay("Shared/NavBarDefault.tpl");
        break;
    }
    $this->Smarty->setDisplay("Alumno/Insertar_alumno.tpl");
    $this->Smarty->setDisplay("Shared/LayoutClose.tpl");
  }

  function frm_asig()
  {
    $this->Smarty->setAssign("titulo", "Sistema Academico");
    $LocalStorageScript = '
      <script>
        sessionStorage.setItem("tipoUsuario", "'.$_SESSION['tipoUsuario'].'"); 
        sessionStorage.setItem("editable", '.$_SESSION['isEditable'].');
        sessionStorage.setItem("idUser", '.$_SESSION['ID'].' );
      </script>         
    ';
    $this->Smarty->setAssign("scriptStorage", $LocalStorageScript);

    $this->Smarty->setDisplay("Shared/LayoutInit.tpl");
    $this->Smarty->setDisplay("Shared/Head.tpl");
    switch ($_SESSION['tipoUsuario']) {
      case 'Alumno':
        $this->Smarty->setDisplay("Shared/NavBarAlumno.tpl");
        break;
      case 'Administrador':
        $this->Smarty->setDisplay("Shared/NavBarAdministrador.tpl");
        break;
      case 'Profesor':
        $this->Smarty->setDisplay("Shared/NavBarProfesor.tpl");
        break;
      case 'Padre':
        $this->Smarty->setDisplay("Shared/NavBarPadre.tpl");
        break;
      default:
        $this->Smarty->setDisplay("Shared/NavBarDefault.tpl");
        break;
    }
    $this->Smarty->setDisplay("Asignatura/Insertar_asignatura.tpl");
    $this->Smarty->setDisplay("Shared/LayoutClose.tpl");
  }

  function frm_nivel()
  {
    $this->Smarty->setAssign("titulo", "Sistema Academico");
    $LocalStorageScript = '
      <script>
        sessionStorage.setItem("tipoUsuario", "'.$_SESSION['tipoUsuario'].'"); 
        sessionStorage.setItem("editable", '.$_SESSION['isEditable'].');
        sessionStorage.setItem("idUser", '.$_SESSION['ID'].' );
      </script>         
    ';
    $this->Smarty->setAssign("scriptStorage", $LocalStorageScript);
    $this->Smarty->setDisplay("Shared/LayoutInit.tpl");
    $this->Smarty->setDisplay("Shared/Head.tpl");
    switch ($_SESSION['tipoUsuario']) {
      case 'Alumno':
        $this->Smarty->setDisplay("Shared/NavBarAlumno.tpl");
        break;
      case 'Administrador':
        $this->Smarty->setDisplay("Shared/NavBarAdministrador.tpl");
        break;
      case 'Profesor':
        $this->Smarty->setDisplay("Shared/NavBarProfesor.tpl");
        break;
      case 'Padre':
        $this->Smarty->setDisplay("Shared/NavBarPadre.tpl");
        break;
      default:
        $this->Smarty->setDisplay("Shared/NavBarDefault.tpl");
        break;
    }
    $this->Smarty->setDisplay("Nivel/Insertar_nivel.tpl");

    $this->Smarty->setDisplay("Shared/LayoutClose.tpl");
  }

  function guardar_nuevo_profesor()
  {
    $id  = $_REQUEST['txtid'];
    $usuario = $_REQUEST['txtusuario'];
    $pass    = $_REQUEST['txtpass'];
    $nombre  = $_REQUEST['txtnombre'];
    $apellidos  = $_REQUEST['txtapellidos'];
    $email  = $_REQUEST['txtemail'];
    $esp = $_REQUEST['cbo_especialista'];

    $rs =  $this->Profesor->insert_profesor($id, $usuario, $pass, $nombre, $apellidos, $email, $esp);
    $vmsg = "";
    if ($rs) {
      $vmsg = "Profesor creado correctamente!";
    } else {
      $vmsg = "Error creando el profesor";
    }
  }

  function guardar_nuevo_alumno()
  {
    $id  = $_REQUEST['txtid'];
    $nivel  = $_REQUEST['txtnivel'];
    $usuario = $_REQUEST['txtusuario'];
    $pass    = $_REQUEST['txtpass'];
    $nombre  = $_REQUEST['txtnombre'];
    $apellidos  = $_REQUEST['txtapellidos'];

    $rs =  $this->Alumno->insert_alumno($id, $nivel, $usuario, $pass, $nombre, $apellidos);
    $vmsg = "";
    if ($rs) {
      $vmsg = "Alumno creado correctamente!";
      $this->sendMenu('
      <script >
        verAlumno('.$id.')
      </script>
      ');
    } else {
      $vmsg = "Error creando el alumno";
    }
  }

  function guardar_nueva_asignatura()
  {
    $id  = $_REQUEST['txtid'];
    $nivel  = $_REQUEST['txtnivel'];
    $profesor = $_REQUEST['txtprofe'];
    $nombre  = $_REQUEST['txtnombre'];

    $rs =  $this->Asignatura->insert_asignatura($id, $nivel, $profesor, $nombre);
    $vmsg = "";
    if ($rs) {
      $vmsg = "Asignatura creada correctamente!";
      $this->sendMenu('
      <script >
      ViewAsignatura('.$id.')
      </script>
      ');
    } else {
      $vmsg = "Error creando la asignatura";
    }
  }

  function guardar_nuevo_nivel()
  {
    $id  = $_REQUEST['txtid'];
    $nivel  = $_REQUEST['txtnivel'];
    $curso = $_REQUEST['txtcurso'];
    $aula  = $_REQUEST['txtaula'];

    $rs =  $this->Nivel->insert_nivel($id, $nivel, $curso, $aula);
    $vmsg = "";
    if ($rs) {
      $vmsg = "Asignatura creada correctamente!";
      $this->sendMenu('<script >fn_listar_nivel();</script>');
    } else {
      $vmsg = "Error creando la asignatura";
    }
  }

  function sendMenu($script){
      /**
     * Define un dato en el cliente que permita identificar si el usuario
     * puede modificar o solo leer datos
     */
    $LocalStorageScript = '
      <script>
        sessionStorage.setItem("tipoUsuario", "'.$_SESSION['tipoUsuario'].'"); 
        sessionStorage.setItem("editable", '.$_SESSION['isEditable'].');
        sessionStorage.setItem("idUser", '.$_SESSION['ID'].' );
      </script>         
    ';
    $this->Smarty->setAssign("scriptStorage", $LocalStorageScript);
    $this->Smarty->setAssign("script", $script);
    $this->Smarty->setAssign("editable",$_SESSION['isEditable']);

    $this->Smarty->setAssign("saludo", "Inicio del proyecto");
    $this->Smarty->setAssign("titulo", "Sistema Academico");
    // llamada a la interfaz
    $this->Smarty->setDisplay("Shared/LayoutInit.tpl");
    $this->Smarty->setDisplay("Shared/Head.tpl");


    switch ($_SESSION['tipoUsuario']) {
      case 'Alumno':
        $this->Smarty->setDisplay("Shared/NavBarAlumno.tpl");
        break;
      case 'Administrador':
        $this->Smarty->setDisplay("Shared/NavBarAdministrador.tpl");
        break;
      case 'Profesor':
        $this->Smarty->setDisplay("Shared/NavBarProfesor.tpl");
        break;
      case 'Padre':
        $this->Smarty->setDisplay("Shared/NavBarPadre.tpl");
        break;
      default:
        $this->Smarty->setDisplay("Shared/NavBarDefault.tpl");
        break;
    }
    $this->Smarty->setDisplay("Shared/body.tpl");
    $this->Smarty->setDisplay("Shared/script.tpl");
    $this->Smarty->setDisplay("Shared/LayoutClose.tpl");
  }

}
