<?php

    # RestFull
    $metodo = $_SERVER['REQUEST_METHOD'];

    switch ($metodo) {
        case 'GET':
          header("HTTP/1.1 200 SUCCESSFUL");
          fn_listar_asig();
          break;
        case 'POST':
            fn_mostrar_frm_asig_edicion();
            break;
        case 'VIEW':
            GetElement();
            break;
        case 'DELETE':
            BorrarNota();
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

    function fn_listar_asig(){
      $linkConect = mysqli_connect("localhost","root","","testingdb");
      $sql = "select count(*) canti_reg from asignatura";
      $rs = $linkConect->query($sql);
      $cantidad_asig = 0;
      $salida = "";
        while($fila = $rs->fetch_assoc()){
          $cantidad_asig = $fila['canti_reg'];
        }
        if($cantidad_asig>0){

            $sql = "select id,nivel_id,profesor_id,nombre from asignatura";
            $rs = $linkConect->query($sql);

            $salida = "<table class='table'>";
              $salida .= "<tr>";
              $salida .= "<th>Id</th>";
              $salida .= "<th>Nivel Id</th>";
              $salida .= "<th>Profesor Id</th>";
              $salida .= "<th>Nombre</th>";
              $salida .= "<th>Acciones</th>";
              $salida .= "</tr>";
              while($fila = $rs->fetch_assoc()){
                $salida .= "<tr>";
                $salida .= "<td>".$fila['id']."</td>";
                $salida .= "<td>".$fila['nivel_id']."</td>";
                $salida .= "<td>".$fila['profesor_id']."</td>";
                $salida .= "<td>".$fila['nombre']."</td>";
                $salida .= "<td><img src='images/lapiz.png' title='Editar Asignatura'
                 onclick='fn_editar_asignatura(".$fila['id'].");'>
                                <img src='images/delete.png' title='Borrar Asignatura'
                                onclick='fn_borrar_asig(".$fila['id'].");'></td>";
                $salida .= "</tr>";
              }
            $salida .= "</table>";
        }else{
            $salida .= "No existen datos para mostrar";
        }

    echo $salida;
    }

    function fn_borrar_asig(){
      $idAsign = $_REQUEST['idAsign'];
      $linkConect = mysqli_connect("localhost","root","","testingdb");
      $sql = "delete from asignatura where id =".$idAsign;
      $rs = $linkConect->query($sql);
      echo "Asignatura Borrada!";
    }

    function fn_mostrar_frm_asig_edicion(){
      $idAsig = $_REQUEST['id'];
      $linkConect = mysqli_connect("localhost","root","","testingdb");

      $sql = "select id,nivel_id,profesor_id,nombre from asignatura where id =".$idAsig;
      $rs = $linkConect->query($sql);

      $nivel = "";
      $profesor = "";
      $nombre = "";

        while($fila = $rs->fetch_assoc()){

           $nivel = $fila['nivel_id'];
           $profesor = $fila['profesor_id'];
           $nombre  = $fila['nombre'];
        }

        $salida = '<div class="container mt-3">';
          $salida .= '<h2>Edición de Asignatura</h2>';
            $salida .= '<form  method="post"  >';
           $salida .= '<input type="hidden" id="txtIdAsig" value="'.$idAsig.'">';
              $salida .= '<div class="mb-3 mt-3">';
                $salida .= '<label for="text">Nivel:</label>';
                $salida .= '<input type="text" class="form-control" id="txtnivel" name="txtnivel" value="'.$nivel.'" placeholder="Ingrese el nivel" required>';
              $salida .= '</div>';

              $salida .= '<div class="mb-3 mt-3">';
                $salida .= '<label for="text">Profesor:</label>';
                $salida .= '<input type="text" class="form-control" id="txtprof" name="txtprof" value="'.$profesor.'" placeholder="Ingrese el profesor" required>';
              $salida .= '</div>';

              $salida .= '<div class="mb-3 mt-3">';
                $salida .= '<label for="text">Nombre:</label>';
                $salida .= '<input type="text" class="form-control" id="txtnombre" name="txtnombre" value="'.$nombre.'" placeholder="Ingrese el nombre de la asignatura" required>';
              $salida .= '</div>';

              $salida .= '<button type="button" class="btn btn-primary" onclick="fn_editar_asig();">Actualizar Asignatura</button>';
            $salida .= '</form>';
          $salida .= '</div>';

      echo $salida;
    }

    /**
     *  Actualiza un elemento
     */
    function UpdateNota(){
        # COMPROBACIONES DE VALORES
        if(ISSET($_REQUEST['idAsignatura'])){ // COMPRUEBA EXISTENCIA
            $id = $_REQUEST['idAsignatura'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "id no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['nivel_id'])){ // COMPRUEBA EXISTENCIA
            $nivel_id = $_REQUEST['nivel_id'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "nivel_id no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['profesor_id'])){ // COMPRUEBA EXISTENCIA
            $profesor_id = $_REQUEST['profesor_id'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "profesor_id no especificado");
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
        $sqlQuery = " UPDATE ASIGNATURA ";
        $sqlQuery .= " SET nivel_id = $nivel_id, profesor_id = $profesor_id , nombre = '$nombre' ";
        $sqlQuery .= " where id = $id ";
        #EJECUCIÓN CONSULTA
        $sqlResult = $linkConnection->query($sqlQuery);
        /* RETORNA JSON */
        header("Content-Type: application/json");
        echo json_encode($sqlResult);
    }

    function BorrarNota(){
        if(ISSET($_REQUEST['id'])){ // COMPRUEBA EXISTENCIA
            $id = $_REQUEST['id'];
            # CADENA DE CONEXIÓN
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");
            # CODIGO SQL
            $sqlQuery = " DELETE FROM ASIGNATURA ";
            $sqlQuery .= " WHERE ID = $id";
            # EJECUTA EL CODIGO
            $sqlResult= $linkConnection->query($sqlQuery);
            /* RETORNA JSON */
            header("Content-Type: application/json");
            echo json_encode($sqlResult);
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "id no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
    }


    /**
     * Inserta un nuevo elemento
     */
    function InsertarElemento(){
        # COMPROBACIONES DE VALORES
        if(ISSET($_REQUEST['idAsignatura'])){ // COMPRUEBA EXISTENCIA
            $id = $_REQUEST['idAsignatura'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "id no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['nivel_id'])){ // COMPRUEBA EXISTENCIA
            $nivel_id = $_REQUEST['nivel_id'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "nivel_id no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['profesor_id'])){ // COMPRUEBA EXISTENCIA
            $profesor_id = $_REQUEST['profesor_id'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "profesor_id no especificado");
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
        $sqlQuery = " INSERT INTO ASIGNATURA (ID, NIVEL_ID, PROFESOR_ID, NOMBRE) ";
        $sqlQuery .= " values( $id, $nivel_id,$profesor_id, '$nombre')  ";
        #EJECUCIÓN CONSULTA
        $sqlResult = $linkConnection->query($sqlQuery);
        /* RETORNA JSON */
        header("Content-Type: application/json");
        echo json_encode($sqlResult);

    }

    /**
     * Descripción: lista todos los elementos existentes
     */
    function ListarElementos(){
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");
        # CODIGO SQL
        $sqlQuery = " SELECT AG.id, AG.nivel_id, N.nivel , AG.profesor_id, P.nombre as NombreProfesor, P.apellidos as ApellidosProfesor, AG.nombre FROM ASIGNATURA as AG ";
            # INNER JOIN PARA  (UNIR TABLAS EN CONSULTA )
            # TRAER NOMBRES DE PROFESOR Y NIVEL
        $sqlQuery .= " inner join Nivel as N on N.id = AG.nivel_id ";
        $sqlQuery .= " inner join Profesor as P on P.id = AG.profesor_id ";
        $sqlQuery .=  " order by AG.id asc";
        # EJECUCIÓN CODIGO
        $sqlResult = $linkConnection->query($sqlQuery);
        # PROCESADO DE RESULTADOS
        $arrayResult = array();
        while($file = $sqlResult->fetch_assoc()){
            $arrayTemp = array();
            $arrayTemp['id'] = $file['id'];
            $arrayTemp['nombre'] = $file['nombre'];
            $arrayTemp['nivel_id'] = $file['nivel_id'];
            $arrayTemp['nivel'] = $file['nivel'];
            $arrayTemp['profesor_id'] = $file['profesor_id'];
            $arrayTemp['profesor_Nombre'] = $file['NombreProfesor']. " " .$file['ApellidosProfesor'] ;
            $arrayResult[] =$arrayTemp;
        }
        /* RETORNA JSON */
        header("Content-Type: application/json");
        echo json_encode($arrayResult);
    }

    /**
     * Retorna un elemento especifico por el id
     */
    function GetElement(){
        if(ISSET($_REQUEST['idAsignatura'])){
            $id = $_REQUEST['idAsignatura'];
            # CADENA DE CONEXIÓN
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");
            # CODIGO SQL
            $sqlQuery = " SELECT AG.id, AG.nivel_id, N.nivel , AG.profesor_id, P.nombre as NombreProfesor, P.apellidos as ApellidosProfesor, AG.nombre FROM ASIGNATURA as AG ";
                # INNER JOIN PARA  (UNIR TABLAS EN CONSULTA )
                # TRAER NOMBRES DE PROFESOR Y NIVEL
            $sqlQuery .= " inner join Nivel as N on N.id = AG.nivel_id ";
            $sqlQuery .= " inner join Profesor as P on P.id = AG.profesor_id ";
            $sqlQuery .= " where AG.id = $id";
            # EJECUCIÓN CODIGO
            $sqlResult = $linkConnection->query($sqlQuery);
            # PROCESADO DE RESULTADOS
            $arrayResult = array();
            while($file = $sqlResult->fetch_assoc()){
                $arrayTemp = array();
                $arrayTemp['id'] = $file['id'];
                $arrayTemp['nombre'] = $file['nombre'];
                $arrayTemp['nivel_id'] = $file['nivel_id'];
                $arrayTemp['nivel'] = $file['nivel'];
                $arrayTemp['profesor_id'] = $file['profesor_id'];
                $arrayTemp['profesor_Nombre'] = $file['NombreProfesor']. " " .$file['ApellidosProfesor'] ;
                $arrayResult[] =$arrayTemp;
            }
            /* RETORNA JSON */
            header("Content-Type: application/json");
            echo json_encode($arrayResult);
        }else{
            $rtn = array("id", "3", "error", "IdHorario no especificado");
            http_response_code(500);
            print json_encode($rtn);
        }
    }

?>
