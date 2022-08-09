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
            //InsertarElemento();
        case 'VIEW':
            GetElement();
            break;
        case 'DELETE':
          header("HTTP/1.1 200 SUCCESSFUL");
          fn_borrar_profesor();
            break;
        case 'PUT':
            UpdateNota();
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

    $idProfesor = "";
    $usuario = "";
    $clave = "";
    $nombre = "";
    $apellidos = "";
    $email = "";
    $especialista = "";

      while($fila = $rs->fetch_assoc()){

        $idProfesor = $fila['id'];
        $usuario = $fila['login'];
        $clave = $fila['clave'];
        $nombre  = $fila['nombre'];
        $apellidos = $fila['apellidos'];
        $email = $fila['email'];
        $especialista = $fila['especialista'];

      }
      $salida = '<div class="container mt-3">';
        $salida .= '<h2>Edición de Profesor</h2>';
          $salida .= '<form  method="post"  >';
         $salida .= '<input type="hidden" id="txtIdProfesor" value="'.$idProfesor.'">';
            $salida .= '<div class="mb-3 mt-3">';
              $salida .= '<label for="text">Usuario:</label>';
              $salida .= '<input type="text" class="form-control" id="txtusuario" name="txtusuario" value="'.$usuario.'" placeholder="Ingrese su nombre de usuario" required>';
            $salida .= '</div>';

            $salida .= '<div class="mb-3 mt-3">';
              $salida .= '<label for="text">Contraseña:</label>';
              $salida .= '<input type="password" class="form-control" id="txtpass" name="txtpass" value="'.$clave.'" placeholder="Ingrese su nueva contraseña" required>';
            $salida .= '</div>';

            $salida .= '<div class="mb-3 mt-3">';
              $salida .= '<label for="text">Nombre:</label>';
              $salida .= '<input type="text" class="form-control" id="txtnombre" name="txtnombre" value="'.$nombre.'" placeholder="Ingrese su nombre" required>';
            $salida .= '</div>';

            $salida .= '<div class="mb-3 mt-3">';
              $salida .= '<label for="text">Apellidos:</label>';
              $salida .= '<input type="text" class="form-control" id="txtap" name="txtap" value="'.$apellidos.'" placeholder="Ingrese sus apellidos" required>';
            $salida .= '</div>';

            $salida .= '<div class="mb-3 mt-3">';
              $salida .= '<label for="text">Email:</label>';
              $salida .= '<input type="text" class="form-control" id="txtemail" name="txtemail" value="'.$email.'" placeholder="Ingrese su email" required>';
            $salida .= '</div>';

            $salida .= '<div class="mb-3">';
              $salida .= '<label for="pwd">Especialista:</label>';
              $salida .= '<select name="cbo_espe">';
              $salida .= '<option>Si</option>';
              $salida .= '<option>No</option>';
              $salida .= '</select>';
            $salida .= '</div>';

            $salida .= '<button type="button" class="btn btn-primary" onclick="fn_editar_usuario();">Actualizar Profesor</button>';
          $salida .= '</form>';
        $salida .= '</div>';

    echo $salida;
  }


    /**
     *  Actualiza un elemento
     */
    function UpdateNota(){
        if(ISSET($_REQUEST['idProfesor'])){ // COMPRUEBA EXISTENCIA
            $id = $_REQUEST['idProfesor'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "idProfesor no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['login'])){ // COMPRUEBA EXISTENCIA
            $login = $_REQUEST['login'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "Algo paso mal...");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(isset($_REQUEST['clave'])){
            $clave = $_REQUEST['clave'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "Algo paso mal...");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['apellidos'])){ // COMPRUEBA EXISTENCIA
            $apellidos = $_REQUEST['apellidos'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "apellidos no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['email'])){ // COMPRUEBA EXISTENCIA
            $email = $_REQUEST['email'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "email no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['especialista'])){ // COMPRUEBA EXISTENCIA
            $especialista = $_REQUEST['especialista'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "especialista no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['nombre'])){ // COMPRUEBA EXISTENCIA
            $nombre = $_REQUEST['nombre'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "nombre no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");
        # CODIGO SQL
        $sqlQuery = " UPDATE PROFESOR ";
        $sqlQuery .= " SET login = '$login', clave = md5('$clave'), nombre = '$nombre', apellidos =  '$apellidos', email = '$email' , especialista = $especialista  ";
        $sqlQuery .= " where id = $id ";
        #EJECUCIÓN CONSULTA
        $sqlResult = $linkConnection->query($sqlQuery);
        /* RETORNA JSON */
        header("Content-Type: application/json");
        echo json_encode($sqlResult);
    }

    function BorrarNota(){
        if(ISSET($_REQUEST['idProfesor'])){ // COMPRUEBA EXISTENCIA
            $id = $_REQUEST['idProfesor'];
            # CADENA DE CONEXIÓN
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");
            # CODIGO SQL
            $sqlQuery = " DELETE FROM PROFESOR ";
            $sqlQuery .= " WHERE ID = $id";
            # EJECUTA EL CODIGO
            $sqlResult= $linkConnection->query($sqlQuery);
            /* RETORNA JSON */
            header("Content-Type: application/json");
            echo json_encode($sqlResult);
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "idProfesor no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
    }


    /**
     * Inserta un nuevo elemento
     */
    function InsertarElemento(){
        if(ISSET($_REQUEST['idProfesor'])){ // COMPRUEBA EXISTENCIA
            $id = $_REQUEST['idProfesor'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "idProfesor no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['login'])){ // COMPRUEBA EXISTENCIA
            $login = $_REQUEST['login'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "Algo paso mal...");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(isset($_REQUEST['clave'])){
            $clave = $_REQUEST['clave'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "Algo paso mal...");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['apellidos'])){ // COMPRUEBA EXISTENCIA
            $apellidos = $_REQUEST['apellidos'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "apellidos no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['email'])){ // COMPRUEBA EXISTENCIA
            $email = $_REQUEST['email'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "email no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['especialista'])){ // COMPRUEBA EXISTENCIA
            $especialista = $_REQUEST['especialista'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "especialista no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['nombre'])){ // COMPRUEBA EXISTENCIA
            $nombre = $_REQUEST['nombre'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "nombre no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");
        # CODIGO SQL
        $sqlQuery = " INSERT INTO PROFESOR (ID, LOGIN, CLAVE, NOMBRE, APELLIDOS, EMAIL, ESPECIALISTA) ";
        $sqlQuery .= " VALUES ( $id , '$clave',md5('$clave'),'$nombre','$apellidos','$email',$especialista) ";
        #EJECUCIÓN CONSULTA
        $sqlResult = $linkConnection->query($sqlQuery);
        /* RETORNA JSON */
        header("Content-Type: application/json");
        echo json_encode($sqlResult);
    }


    /**
     * Retorna un elemento especifico por el id
     */
    function GetElement(){
        if(ISSET($_REQUEST['idProfesor'])){
            $id = $_REQUEST['idProfesor'];
            # CADENA DE CONEXIÓN
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");
            # codigo SQL
            $sqlQuery = " SELECT * FROM PROFESOR ";
            $sqlQuery .= " WHERE id = $id ";
            # EJECUTA EL CODIGO
            $sqlResult= $linkConnection->query($sqlQuery);
            #PROCESADO DE RESULTADOS
            $arrayResult = null;
            while($file = $sqlResult->fetch_assoc()){
                $arrayTemp = array();
                $arrayTemp['id'] = $file['id'];
                $arrayTemp['login'] = $file['login'];
                $arrayTemp['nombre'] = $file['nombre'];
                $arrayTemp['apellidos'] = $file['apellidos'];
                $arrayTemp['email'] = $file['email'];
                $arrayTemp['especialista'] = $file['especialista'];
                $arrayResult =$arrayTemp;
            }
            /* RETORNA JSON */
            header("Content-Type: application/json");
            echo json_encode($arrayResult);
        }else{
            $rtn = array("id", "3", "error", "IdProfesor no especificado");
            http_response_code(500);
            print json_encode($rtn);
        }

    }
