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
        case 'VIEW':
            viewAsignatura();
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


    function viewAsignatura(){
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
            $AsignaturaObjecto = new stdClass();
            $sqlQuery = 'SELECT * FROM ASIGNATURA WHERE ID = '.$id;
            $SQLResult = $linkConnection->query($sqlQuery);            
            while($fila = $SQLResult->fetch_assoc()){
                $AsignaturaObjecto->id = $fila['id'];
                $AsignaturaObjecto->nivelId = $fila['nivel_id'];
                $AsignaturaObjecto->id = $fila['id'];
                $AsignaturaObjecto->profesorId  = $fila['profesor_id'];
                $AsignaturaObjecto->nombreAsignatura = $fila['nombre'];
            }
            $AsignaturaObjecto->Horarios =  listaHorarios($id);
            $AsignaturaObjecto->Ausencias = listaAusencias($id);
            $AsignaturaObjecto->Alumnos = listaAlumnos($id);
            $AsignaturaObjecto->Notas = listaNotas($id);

            lanzarJson($AsignaturaObjecto,false,200);
        } else {
            lanzarJson("Error id no especificado",true,500);
            exit;
        }
    }


    function listaHorarios($id){
        if (isset($id)) {
            $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
            $sqlQuery = 'SELECT * FROM HORARIO WHERE ASIGNATURA_ID = '.$id;
            $SQLResult = $linkConnection->query($sqlQuery);            
            $tmpArray = array();
            while($fila = $SQLResult->fetch_assoc()){
                $horarioTMP = new stdClass();
                $horarioTMP->id = $fila['id'];                                                              
                $horarioTMP->dia = $fila['dia'];                    
                $horarioTMP->horaInicio = $fila['horaInicio'];    
                $horarioTMP->horaFin = $fila['horaFin'];    
                array_push($tmpArray,$horarioTMP);
            }
            return $tmpArray;
        } else {
            return array();
        }
    }    


    function listaNotas($id){
        if (isset($id)) {
            $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
            $sqlQuery = '
            SELECT 
                N.id as notaId, 
                N.nota,
                N.trimestre,
                A.id as alumnoId,
                CONCAT(A.nombre ," ",   A.apellidos) as nombreAlumno 
            FROM NOTA AS N
            INNER JOIN (select id, alumno_id from Asignatura_has_alumno where asignatura_id ='.$id.') AS TMP 
            inner join Alumno as A on A.id = TMP.alumno_id 
            ON TMP.ID = N.asignatura_has_alumno_id        
            ';
            $SQLResult = $linkConnection->query($sqlQuery);            
            $tmpArray = array();
            while($fila = $SQLResult->fetch_assoc()){
                $notaTmp = new stdClass();
                $notaTmp->notaId = $fila['notaId'];
                $notaTmp->alumnoId = $fila['alumnoId'];
                $notaTmp->nota = $fila['nota'];
                $notaTmp->trimestre = $fila['trimestre'];
                $notaTmp->nombreAlumno = $fila['nombreAlumno'];                                                                
                array_push($tmpArray,$notaTmp);
            }
            return $tmpArray;
        } else {
            return array();
        }
    }    

    function listaAlumnos($id){
        if (isset($id)) {
            $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
            $sqlQuery = '
            SELECT 
                Alum.id as AlumnoId,
                Alum.Nombre as NombreAlumno,
                Alum.Apellidos as ApellidosAlumno
            FROM ASIGNATURA_HAS_Alumno as AHA
            inner join Alumno as Alum on Alum.id = AHA.alumno_id
            where AHA.asignatura_id = '.$id;
            $SQLResult = $linkConnection->query($sqlQuery);            
            $tmpArray = array();
            while($fila = $SQLResult->fetch_assoc()){
                $Alumnotmp = new stdClass();
                $Alumnotmp->Id = $fila['AlumnoId'];
                $Alumnotmp->nombreAlumno = $fila['NombreAlumno'];
                $Alumnotmp->apellidosAlumno = $fila['ApellidosAlumno'];
                array_push($tmpArray,$Alumnotmp);
            }
            return $tmpArray;
        } else {
            return array();
        }
    }    

    function listaAusencias($id){
        if (isset($id)) {
            $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
            $sqlQuery = '
            SELECT 
                FA.id as faltaAsistenciaId,
                Fa.fecha,
                FA.Asignatura_id,
                Alum.id as alumnoId,
                Alum.nombre as alumnoNombre,
                Alum.apellidos as alumnoApellidos
            FROM FALTA_ASISTENCIA AS FA
            inner join  Alumno as Alum on Alum.id = FA.alumno_id
            WHERE FA.asignatura_id = '.$id.'
            order by fecha desc';
            $SQLResult = $linkConnection->query($sqlQuery);            
            $tmpArray = array();
            while($fila = $SQLResult->fetch_assoc()){
                $Ausencia = new stdClass();
                $Ausencia->id = $fila['faltaAsistenciaId'];
                $Ausencia->fecha = $fila['fecha'];
                $Ausencia->signaturaId = $fila['Asignatura_id'];
                $Ausencia->alumnoId = $fila['alumnoId'];
                $Ausencia->alumnoNombre = $fila['alumnoNombre'];
                $Ausencia->alumnoApellidos = $fila['alumnoApellidos'];
                array_push($tmpArray,$Ausencia);
            }
            return $tmpArray;
        } else {
            return array();
        }
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
                                $salida .= ' <td onclick="ViewAsignatura('.$fila['id'].')" class="btn btn-sm text-dark btn-danger" > <i class="bi-info-circle"></i> </td>';        
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

    /**
 * Lanza una respuesta en formato JSON
 */
function lanzarJson( $DataCodificar, $error=true, $CodigoError){
    if($error){
        $rtn = array("id", "1", "error", $DataCodificar);
        http_response_code($CodigoError);
        print json_encode($rtn);
    }else{
        http_response_code($CodigoError);
        print json_encode($DataCodificar);
    }
  }
