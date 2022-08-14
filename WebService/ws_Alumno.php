<?php

$metodo = $_SERVER['REQUEST_METHOD'];
//$accion = $_REQUEST['accion'];

switch ($metodo) {
  case 'GET':
    header("HTTP/1.1 200 SUCCESSFUL");
    fn_listar_alumnos();
    break;
  case 'DELETE':
      header("HTTP/1.1 200 SUCCESSFUL");
      fn_borrar_alumno();
      break;
  case 'POST':
      header("HTTP/1.1 200 SUCCESSFUL");
      fn_mortrar_frm_alumno_edicion();
      break;
  case 'PUT':
      header("HTTP/1.1 200 SUCCESSFUL");
      PostUpdateAlumno();
      break;
  default:
    // code...
    break;
}

function PostUpdateAlumno()
{
    # CADENA DE CONEXIÓN
    $flag = true;
    $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
    # VALIDACIONES
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    } else {
        $rtn = array("id", "3", "error", "Id no especificado");
        http_response_code(500);
        print json_encode($rtn);
        $flag = false;
        exit;
    }
    if (isset($_REQUEST['nivel_id'])) {
        $nivel_id = $_REQUEST['nivel_id'];
    } else {
        $rtn = array("id", "3", "error", "nivel_id no especificado");
        http_response_code(500);
        print json_encode($rtn);
        $flag = false;
        exit;
    }
    if (isset($_REQUEST['login'])) {
        $login = $_REQUEST['login'];
    } else {
        $rtn = array("id", "3", "error", "login no especificado");
        http_response_code(500);
        print json_encode($rtn);
        $flag = false;
        exit;
    }
    if (isset($_REQUEST['clave'])) {
        $clave = $_REQUEST['clave'];
    } else {
        $rtn = array("id", "3", "error", "clave no especificado");
        http_response_code(500);
        print json_encode($rtn);
        $flag = false;
        exit;
    }
    if (isset($_REQUEST['nombre'])) {
        $nombre = $_REQUEST['nombre'];
    } else {
        $rtn = array("id", "3", "error", "nombre no especificado");
        http_response_code(500);
        print json_encode($rtn);
        $flag = false;
        exit;
    }
    if (isset($_REQUEST['apellidos'])) {
        $apellidos = $_REQUEST['apellidos'];
    } else {
        $rtn = array("id", "3", "error", "apellidos no especificado");
        http_response_code(500);
        print json_encode($rtn);
        $flag = false;
        exit;
    }
    if ($flag) {
        # CODIGO SQL
        $sqlQuery = "UPDATE alumno ";
        $sqlQuery = $sqlQuery . "set nivel_id='$nivel_id',login= '$login',clave = '$clave',nombre ='$nombre',apellidos = '$apellidos'";
        $sqlQuery = $sqlQuery . " WHERE id = '$id' ";
        $sqlResults = $linkConnection->query($sqlQuery);
        /* RETORNA JSON */
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode($sqlResults);
    }
}

function fn_mortrar_frm_alumno_edicion(){
  $idAlumno = $_REQUEST['idAlumno'];
  $linkConect = mysqli_connect("localhost","root","","testingdb");

  $sql = "select id,nivel_id,login,clave, nombre, apellidos from alumno where id=".$idAlumno;
  $rs = $linkConect->query($sql);

  $idAlumno = "";
  $idNivel = "";
  $login = "";
  $clave = "";
  $nombre = "";
  $apellidos = "";

    while($fila = $rs->fetch_assoc()){
      $idAlumno = $fila['id'];
      $idNivel = $fila['nivel_id'];
      $login = $fila['login'];
      $clave = $fila['clave'];
      $nombre = $fila['nombre'];
      $apellidos = $fila['apellidos'];

    }
    $salida = '<div class="container mt-3">';
      $salida .= '<h2>Edición de Alumno</h2>';
        $salida .= '<form  method="post"  >';
       $salida .= '<input type="hidden" id="txtIdAlumno" value="'.$idAlumno.'">';
       $salida .= '<div class="mb-3 mt-3">';
         $salida .= '<label for="text">Nivel:</label>';
         $salida .= '<input type="text" class="form-control" id="txtnivelid" name="txtnombre" value="'.$idNivel.'" placeholder="Ingrese el id de su nivel" required>';
       $salida .= '</div>';
          $salida .= '<div class="mb-3 mt-3">';
            $salida .= '<label for="text">Login:</label>';
            $salida .= '<input type="text" class="form-control" id="txtlogin" name="txtnombre" value="'.$login.'" placeholder="Ingrese su nombre de usuario" required>';
          $salida .= '</div>';
          $salida .= '<div class="mb-3 mt-3">';
            $salida .= '<label for="text">Contraseña:</label>';
            $salida .= '<input type="password" class="form-control" id="txtpass" name="txtpass" value="'.$clave.'" placeholder="Ingrese su contraseña" required>';
          $salida .= '</div>';
          $salida .= '<div class="mb-3 mt-3">';
            $salida .= '<label for="text">Nombre:</label>';
            $salida .= '<input type="text" class="form-control" id="txtnombre" name="txtUsuario" value="'.$nombre.'" placeholder="Ingrese su nombre" required>';
          $salida .= '</div>';
          $salida .= '<div class="mb-3 mt-3">';
            $salida .= '<label for="text">Apellido:</label>';
            $salida .= '<input type="text" class="form-control" id="txtapellido" name="txtUsuario" value="'.$apellidos.'" placeholder="Ingrese su apellido" required>';
          $salida .= '</div>';
          $salida .= '<div class="mb-3">';

          $salida .= '<button type="button" class="btn btn-primary" onclick="UpdateAlumno();" >Actualizar Alumno</button>';
        $salida .= '</form>';
      $salida .= '</div>';

  echo $salida;
}

function fn_borrar_alumno(){
  $idAlumno = $_REQUEST['idAlumno'];
  $linkConect = mysqli_connect("localhost","root","","testingdb");
  $sql = "delete from alumno where id=".$idAlumno;
  $rs = $linkConect->query($sql);
  echo "Alumno Borrado!";
}
function fn_listar_alumnos(){
  $linkConect = mysqli_connect("localhost","root","","testingdb");
  $sql = "select count(*) canti_reg from alumno";
  $rs = $linkConect->query($sql);
  $cantidad_alumno = 0;
  $salida = "";
    while($fila = $rs->fetch_assoc()){
      $cantidad_alumno = $fila['canti_reg'];
    }
    if($cantidad_alumno>0){

        $sql = "select id,nivel_id,login,nombre,apellidos from alumno";
        $rs = $linkConect->query($sql);

        $salida = "<table class='table'>";
          $salida .= "<tr>";
          $salida .= "<th>Id Alumno</th>";
          $salida .= "<th>Id Nivel</th>";
          $salida .= "<th>Login</th>";
          $salida .= "<th>Nombre</th>";
          $salida .= "<th>Apellidos</th>";
          $salida .= "<th>Acciones</th>";
          $salida .= "</tr>";
          while($fila = $rs->fetch_assoc()){
            $salida .= "<tr>";
            $salida .= "<td>".$fila['id']."</td>";
            $salida .= "<td>".$fila['nivel_id']."</td>";
            $salida .= "<td>".$fila['login']."</td>";
            $salida .= "<td>".$fila['nombre']."</td>";
            $salida .= "<td>".$fila['apellidos']."</td>";
            $salida .= "<td><img src='images/lapiz.png' title='Editar Alumno'
             onclick='fn_editar_alumno(".$fila['id'].");'>
                            <img src='images/delete.png' title='Borrar Alumno'
                            onclick='fn_borrar_alumno(".$fila['id'].");'></td>";


            $salida .= "</tr>";

          }

        $salida .= "</table>";
    }else{
        $salida .= "No existen datos para mostrar";
    }

echo $salida;
}







?>
