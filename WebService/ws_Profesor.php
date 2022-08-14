<?php

    # RestFull
    $metodo = $_SERVER['REQUEST_METHOD'];

    switch ($metodo) {
        case 'GET':
          header("HTTP/1.1 200 SUCCESSFUL");
          fn_listar_profesor();
          break;
        case 'POST':
          header("HTTP/1.1 200 SUCCESSFUL");
          editar_p();
          break;
        case 'DELETE':
          header("HTTP/1.1 200 SUCCESSFUL");
          fn_borrar_profesor();
            break;
        case 'PUT':
            UpdateProfesor();
            break;
        default:
            /**
             * SI EL METODO ES DIFERENTE, DEVUELVE ESTA RESPUESTA
             */
            $rtn = array("id", "3", "error", "Algo paso mal...");
            http_response_code(500);
            print json_encode($rtn);
            break;
    }


    function UpdateProfesor()
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
        if (isset($_REQUEST['email'])) {
            $email = $_REQUEST['email'];
        } else {
            $rtn = array("id", "3", "error", "email no especificado");
            http_response_code(500);
            print json_encode($rtn);
            $flag = false;
            exit;
        }
        if (isset($_REQUEST['especialista'])) {
            $especialista = $_REQUEST['especialista'];
        } else {
            $rtn = array("id", "3", "error", "especialista no especificado");
            http_response_code(500);
            print json_encode($rtn);
            $flag = false;
            exit;
        }
        if ($flag) {
            # CODIGO SQL
            $sqlQuery = "UPDATE profesor ";
            $sqlQuery = $sqlQuery . "set login= '$login', clave = '$clave', nombre ='$nombre', apellidos = '$apellidos', email = '$email', especialista = $especialista";
            $sqlQuery = $sqlQuery . " WHERE id = $id;";
            $sqlResults = $linkConnection->query($sqlQuery);
            /* RETORNA JSON */
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($sqlResults);
        }
    }

    /**
     * Descripción: lista todos los elementos existentes
     */
    function fn_listar_profesor(){
      $linkConect = mysqli_connect("localhost","root","","testingdb");
      $sql = "select count(*) canti_reg from profesor";
      $rs = $linkConect->query($sql);
      $cantidad_usuario = 0;
      $salida = "";
        while($fila = $rs->fetch_assoc()){
          $cantidad_usuario = $fila['canti_reg'];
        }
        if($cantidad_usuario>0){

            $sql = "select id,login,nombre,apellidos,email,especialista from profesor";
            $rs = $linkConect->query($sql);

            //$tit ="<h1>Lista de Profesores</h1> "

            $salida = "<table class='table'>";
              $salida .= "<tr>";
              $salida .= "<th>Id</th>";
              $salida .= "<th>Usuario</th>";
              $salida .= "<th>Nombre</th>";
              $salida .= "<th>Apellidos</th>";
              $salida .= "<th>Email</th>";
              $salida .= "<th>Especialista</th>";
              $salida .= "<th>Acciones</th>";
              $salida .= "</tr>";
              while($fila = $rs->fetch_assoc()){
                $salida .= "<tr>";
                $salida .= "<td>".$fila['id']."</td>";
                $salida .= "<td>".$fila['login']."</td>";
                $salida .= "<td>".$fila['nombre']."</td>";
                $salida .= "<td>".$fila['apellidos']."</td>";
                $salida .= "<td>".$fila['email']."</td>";
                $salida .= "<td>".$fila['especialista']."</td>";
                $salida .= "<td><img src='images/lapiz.png' title='Editar Usuario'
                 onclick='fn_editar_profesor(".$fila['id'].");'>
                                <img src='images/delete.png' title='Borrar Usuario'
                                onclick='fn_borrar_profesor(".$fila['id'].");'></td>";
                $salida .= "</tr>";
              }
            $salida .= "</table>";
        }else{
            $salida .= "No existen datos para mostrar";
        }

    echo $salida;
    }

  function fn_borrar_profesor(){
    $idProfesor = $_REQUEST['idProfesor'];
    $linkConect = mysqli_connect("localhost","root","","testingdb");
    $sql = "delete from profesor where id =".$idProfesor;
    $rs = $linkConect->query($sql);
    echo "Usuario Borrado!";
  }

  function editar_p(){
    $idProfesor = $_REQUEST['idProfesor'];
    $linkConect = mysqli_connect("localhost","root","","testingdb");

    $sql = "select id,login,clave,nombre,apellidos,email,especialista from profesor where id=".$idProfesor;
    $rs = $linkConect->query($sql);


    #   RETORNO JSON
      while($fila = $rs->fetch_assoc()){
        $salida = '<div class="container mt-3">';
        $salida .= '<h2>Edición de Profesor</h2>';
          $salida .= '<form  method="post"  >';
         $salida .= '<input type="hidden" id="txtIdProfesor" value="'.$fila['id'].'">';
            $salida .= '<div class="mb-3 mt-3">';
              $salida .= '<label for="text">Usuario:</label>';
              $salida .= '<input type="text" class="form-control" id="txtusuario" name="txtusuario" value="'.$fila['login'].'" placeholder="Ingrese su nombre de usuario" required>';
            $salida .= '</div>';

            $salida .= '<div class="mb-3 mt-3">';
              $salida .= '<label for="text">Contraseña:</label>';
              $salida .= '<input type="password" class="form-control" id="txtpass" name="txtpass" value="'.$fila['clave'].'" placeholder="Ingrese su nueva contraseña" required>';
            $salida .= '</div>';

            $salida .= '<div class="mb-3 mt-3">';
              $salida .= '<label for="text">Nombre:</label>';
              $salida .= '<input type="text" class="form-control" id="txtnombre" name="txtnombre" value="'.$fila['nombre'].'" placeholder="Ingrese su nombre" required>';
            $salida .= '</div>';

            $salida .= '<div class="mb-3 mt-3">';
              $salida .= '<label for="text">Apellidos:</label>';
              $salida .= '<input type="text" class="form-control" id="txtap" name="txtap" value="'.$fila['apellidos'].'" placeholder="Ingrese sus apellidos" required>';
            $salida .= '</div>';

            $salida .= '<div class="mb-3 mt-3">';
              $salida .= '<label for="text">Email:</label>';
              $salida .= '<input type="text" class="form-control" id="txtemail" name="txtemail" value="'.$email = $fila['email'].'" placeholder="Ingrese su email" required>';
            $salida .= '</div>';

            $salida .= '<div class="mb-3">';
              $salida .= '<label for="pwd">Especialista:</label>';
              $salida .= '<select name="cbo_espe">';
              $salida .= '<option>Si</option>';
              $salida .= '<option>No</option>';
              $salida .= '</select>';
            $salida .= '</div>';

            $salida .= '<button type="button" class="btn btn-primary" onclick="PostUpdateProfesor();">Actualizar Profesor</button>';
          $salida .= '</form>';
        $salida .= '</div>';

      }


    echo $salida;
  }
