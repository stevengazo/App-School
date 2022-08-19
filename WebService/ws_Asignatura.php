<?php

    # RestFull
    $metodo = $_SERVER['REQUEST_METHOD'];

    /**
     * Administra los metodos del web service
     */
    switch ($metodo) {
        case 'GET':
          fn_listar_asig();
          break;
        case 'POST':
            fn_mostrar_frm_asig_edicion();
            break;
        case 'DELETE':
            BorrarAsig();
            break;
        case 'PUT':
            UpdateAsignatura();
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
     * Valida los datos de una asignatura y la actualiza
     */
   function UpdateAsignatura()
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
        if (isset($_REQUEST['profesor_id'])) {
            $profesor_id = $_REQUEST['profesor_id'];
        } else {
            $rtn = array("id", "3", "error", "profesor_id no especificado");
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
        if ($flag) {
            # CODIGO SQL
            $sqlQuery = "UPDATE asignatura ";
            $sqlQuery = $sqlQuery . "set nivel_id= '$nivel_id', profesor_id = '$profesor_id', nombre ='$nombre'";
            $sqlQuery = $sqlQuery . " WHERE id = $id;";
            $sqlResults = $linkConnection->query($sqlQuery);
            /* RETORNA JSON */
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($sqlResults);
        }
    }

    /**
     * lista los elementos de la base de datos
     */
    function fn_listar_asig(){
        if(ISSET($_REQUEST['tipo'])){ // COMPRUEBA EXISTENCIA
            $typo = $_REQUEST['tipo'];
            $linkConect = mysqli_connect("localhost","root","","testingdb");
            switch ($typo) {
                case 'listaHtml':
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
                    header("HTTP/1.1 200 SUCCESSFUL");
                    echo $salida;
                    break;
                case 'Json':
                    $sql = '
                    SELECT A.*, P.nombre as nombreProfesor, P.Apellidos as ApellidosProfesor  FROM ASIGNATURA AS A
                    INNER join Profesor as P on P.id = A.profesor_id
                    ';
                    $rs = $linkConect->query($sql);
                    $arrayResult = array();
                    while($fila = $rs->fetch_assoc()){
                        $tmpArray = array();
                        $tmpArray['id'] = $fila['id'];
                        $tmpArray['nivel_id'] = $fila['nivel_id'];
                        $tmpArray['nombre'] = $fila['nombre'];
                        $tmpArray['profesor_id'] = $fila['profesor_id'];
                        $tmpArray['nombreProfesor'] = $fila['nombreProfesor']." ".$fila['ApellidosProfesor'];
                        array_push($arrayResult,$tmpArray);
                    }
                    http_response_code(200);
                    header("HTTP/1.1 200 SUCCESSFUL");
                    print json_encode($arrayResult);
                    break;
                default:
                    $rtn = array("id", "3", "error", "tipo especificado no valido");
                    http_response_code(500);
                    print json_encode($rtn);
                    break;
            }

        }else{
            $rtn = array("id", "3", "error", "tipo no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }


    }

    /**
     * Borra una asignatura para
     */
    function fn_borrar_asig(){
      $idAsign = $_REQUEST['idAsign'];
      $linkConect = mysqli_connect("localhost","root","","testingdb");
      $sql = "delete from asignatura where id =".$idAsign;
      $rs = $linkConect->query($sql);
      echo "Asignatura Borrada!";
    }

    /**
     * Vista de edición de una asignatura
     */
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
              $salida .= '<button type="button" class="btn btn-primary" onclick="PostUpdateAsignatura();">Actualizar Asignatura</button>';
            $salida .= '</form>';
          $salida .= '</div>';
      echo $salida;
    }

    /**
     * Borra una asignatura
     */
    function BorrarAsig(){
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
            lanzarJson("EL id no fue asignado", true, 500);
            exit;
        }
    }
