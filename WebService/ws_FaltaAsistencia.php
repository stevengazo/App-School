<?php

# RestFull

use LDAP\Result;

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'GET':
        ListarElementos();
        break;
    case 'POST':
        InsertarElemento();
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

/**
 *  Actualiza un elemento
 */
function UpdateNota()
{
    # CADENA DE CONEXIÓN
    $flag = true;
    $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
    # VALIDACIONES          
    if (isset($_REQUEST['faltaAsistenciaId'])) {
        $id = $_REQUEST['faltaAsistenciaId'];
    } else {
        $rtn = array("id", "3", "error", "faltaAsistenciaId no especificado");
        http_response_code(500);
        print json_encode($rtn);
        $flag = false;
        exit;
    }
    if (isset($_REQUEST['alumno_id'])) {
        $alumno_id = $_REQUEST['alumno_id'];
    } else {
        $rtn = array("id", "3", "error", "alumno_id no especificado");
        http_response_code(500);
        print json_encode($rtn);
        $flag = false;
        exit;
    }
    if (isset($_REQUEST['asignatura_id'])) {
        $asignatura_id = $_REQUEST['asignatura_id'];
    } else {
        $rtn = array("id", "3", "error", "asignatura_id no especificado");
        http_response_code(500);
        print json_encode($rtn);
        $flag = false;
        exit;
    }
    if (isset($_REQUEST['fecha'])) {
        $fecha = $_REQUEST['fecha'];
    } else {
        $rtn = array("id", "3", "error", "fecha no especificado");
        http_response_code(500);
        print json_encode($rtn);
        $flag = false;
        exit;
    }
    if (isset($_REQUEST['justificada'])) {
        $justificada = $_REQUEST['justificada'];
    } else {
        $rtn = array("id", "3", "error", "justificada no especificado");
        http_response_code(500);
        print json_encode($rtn);
        $flag = false;
        exit;
    }
    if ($flag) {
        # CODIGO SQL
        $sqlQuery = "UPDATE falta_asistencia  ";
        $sqlQuery = $sqlQuery . " set  alumno_id = $alumno_id, asignatura_id = $asignatura_id, fecha = '$fecha', justificada = '$justificada'";
        $sqlQuery = $sqlQuery . " WHERE id = $id;";
        $sqlResults = $linkConnection->query($sqlQuery);
        /* RETORNA JSON */
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode($sqlResults);
    }
}

function BorrarNota()
{
    # CADENA DE CONEXIÓN
    $flag = TRUE;
    $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
    # VALIDACIONES          
    if (isset($_REQUEST['faltaAsistenciaId'])) {
        $id = $_REQUEST['faltaAsistenciaId'];
    } else {
        $rtn = array("id", "3", "error", "faltaAsistenciaId no especificado");
        http_response_code(500);
        print json_encode($rtn);
        $flag = false;
        exit;
    }
    if ($flag) {
        # CODIGO SQL
        $sqlQuery = "DELETE FROM falta_asistencia WHERE id = $id";
        $sqlResults = $linkConnection->query($sqlQuery);
        /* RETORNA JSON */
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode($sqlResults);
        exit;
    }
}


/**
 * Inserta un nuevo elemento 
 */
function InsertarElemento()
{
    # CADENA DE CONEXIÓN
    $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");

    # Validaciones        
    if (isset($_REQUEST['faltaAsistenciaId'])) {
        $id = $_REQUEST['faltaAsistenciaId'];
    } else {
        $rtn = array("id", "3", "error", "faltaAsistenciaId no especificado");
        http_response_code(500);
        print json_encode($rtn);
        exit;
    }
    if (isset($_REQUEST['alumno_id'])) {
        $alumno_id = $_REQUEST['alumno_id'];
    } else {
        $rtn = array("id", "3", "error", "alumno_id no especificado");
        http_response_code(500);
        print json_encode($rtn);
        exit;
    }
    if (isset($_REQUEST['asignatura_id'])) {
        $asignatura_id = $_REQUEST['asignatura_id'];
    } else {
        $rtn = array("id", "3", "error", "asignatura_id no especificado");
        http_response_code(500);
        print json_encode($rtn);
        exit;
    }
    if (isset($_REQUEST['fecha'])) {
        $fecha = $_REQUEST['fecha'];
    } else {
        $rtn = array("id", "3", "error", "fecha no especificado");
        http_response_code(500);
        print json_encode($rtn);
        exit;
    }
    if (isset($_REQUEST['justificada'])) {
        $justificada = $_REQUEST['justificada'];
    } else {
        $rtn = array("id", "3", "error", "justificada no especificado");
        http_response_code(500);
        print json_encode($rtn);
        exit;
    }
    # CODIGO SQL
    $sqlQuery = "INSERT INTO falta_asistencia( id, alumno_id,asignatura_id, fecha, justificada) ";
    $sqlQuery .= " values ($id, $alumno_id, $asignatura_id, '$fecha', '$justificada'	);";
    $sqlResults = $linkConnection->query($sqlQuery);            
    echo $sqlResults;
}

/**
 * Descripción: lista todos los elementos existentes
 */
function ListarElementos()
{
    if (isset($_REQUEST['type'])) {
        $type = $_REQUEST['type'];
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        switch ($type) {
            case 'Elements':
                # CODIGO SQL
                $sqlQuery = "select falta_asistencia.id, alumno.nombre, alumno.apellidos, asignatura.nombre as nombreAsignatura  , fecha, justificada from falta_asistencia";
                $sqlQuery = $sqlQuery . " inner join alumno on alumno.id = falta_asistencia.alumno_id ";
                $sqlQuery = $sqlQuery . " inner join asignatura on falta_asistencia.asignatura_id = asignatura.id";
                $sqlResults = $linkConnection->query($sqlQuery);
                # Procesado de la respuesta
                $htmlResult  = " <div class='d-flex flex-column'> ";
                $htmlResult .= "    <h3>Lista de Ausencias</h3> ";
                $htmlResult .= "    <table class='table table-striped'>";
                $htmlResult .= "        <thead> ";
                $htmlResult .= "            <tr>";
                $htmlResult .= "               <th>n°</th> ";
                $htmlResult .= "               <th>Alumno</th> ";
                $htmlResult .= "               <th>Fecha°</th> ";
                $htmlResult .= "               <th>Asignatura°</th> ";
                $htmlResult .= "               <th>Justificar</th> ";
                $htmlResult .= "               <th>Acciones</th> ";
                $htmlResult .= "            </tr>";
                $htmlResult .= "        </thead>";
                $htmlResult .= "        <tbody>";
                while ($fila = $sqlResults->fetch_assoc()) {
                    $htmlResult .= " <tr>";
                    $htmlResult .= " <td>" . $fila['id'] . "</td>";
                    $htmlResult .= " <td>" . $fila['nombre'] . " " . $fila['apellidos'] . "</td>";
                    $htmlResult .= " <td>" . $fila['fecha'] . "</td>";
                    $htmlResult .= " <td>" . $fila['nombreAsignatura'] . "</td>";
                    $htmlResult .= " <td>" . $fila['justificada'] . "</td>";
                    $htmlResult .= " <td onclick='ViewFaltaAsistencia(" . $fila['id'] . ")' class='btn bg-white btn-sm text-dark btn-info' > Detalles </td>";
                    $htmlResult .= " <td onclick='GetUpdateFaltaAsistencia(" . $fila['id'] . ")' class='btn bg-white btn-sm text-dark btn-primary' > Modificar </td>";
                    $htmlResult .= " <td onclick='GetDeleteFaltaAsistencia(" . $fila['id'] . ")' class='btn bg-white btn-sm text-dark btn-danger' > Eliminar </td>";
                    $htmlResult .= " </tr>";
                }
                $htmlResult .= "        </tbody>";
                $htmlResult .= "    </table>";
                $htmlResult .= " </div>";
                echo $htmlResult;
                break;
            case 'lastId':
                $sqlQuery = "select id from falta_asistencia order by id desc limit 1";
                $sqlResults = $linkConnection->query($sqlQuery);
                $result = new stdClass();
                while($fila = $sqlResults->fetch_assoc()){
                    $result->id= $fila['id'];                
                }                
                http_response_code(200);
                print json_encode($result);
                break;  
            case 'elementById':
                if(isset($_REQUEST['id'])){
                    $id = $_REQUEST['id'];
                    $sqlQuery = "select falta_asistencia.id, alumno.id as alumnoId, asignatura.id as asignaturaId, alumno.nombre, alumno.apellidos, asignatura.nombre as nombreAsignatura , fecha, justificada from falta_asistencia";                    
                    $sqlQuery = $sqlQuery." inner join alumno on alumno.id = falta_asistencia.alumno_id  ";
                    $sqlQuery = $sqlQuery." inner join asignatura on falta_asistencia.asignatura_id = asignatura.id ";
                    $sqlQuery = $sqlQuery." where falta_asistencia.id = $id ";
                    $sqlResults = $linkConnection->query($sqlQuery);
                    $arraResult = array();
                    while ($fila = $sqlResults->fetch_assoc()) {
                        $arraResult['id'] = $fila['id'];
                        $arraResult['alumno_id'] = $fila['alumnoId'];
                        $arraResult['asignatura_id'] = $fila['asignaturaId'];
                        $arraResult['nombre'] = $fila['nombre'];
                        $arraResult['apellidos'] = $fila['apellidos'];
                        $arraResult['asignatura'] = $fila['nombreAsignatura'];
                        $arraResult['fecha'] = $fila['fecha'];
                        $arraResult['justificada'] = $fila['justificada'];
                    }
                    http_response_code(200);
                    print json_encode($arraResult);
                }
                break;          
            default:
                $rtn = array("id", "3", "error", "type no especificado");
                http_response_code(500);
                print json_encode($rtn);
                break;
        }
    }
}

/**
 * Retorna un elemento especifico por el id
 */
function GetElement()
{
    # CADENA DE CONEXIÓN
    $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
    # CODIGO SQL
    $sqlQuery = " ";
    if (isset($_REQUEST['faltaAsistenciaId'])) {
        $id = $_REQUEST['faltaAsistenciaId'];
        $sqlQuery = "select falta_asistencia.id, alumno.id as alumnoId, asignatura.id as asignaturaId, alumno.nombre, alumno.apellidos, asignatura.nombre as nombreAsignatura , fecha, justificada from falta_asistencia";
        $sqlQuery = $sqlQuery . " inner join alumno on alumno.id = falta_asistencia.alumno_id  ";
        $sqlQuery = $sqlQuery . " inner join asignatura on falta_asistencia.asignatura_id = asignatura.id ";
        $sqlQuery = $sqlQuery . " where falta_asistencia.id = $id ";
        $sqlResults = $linkConnection->query($sqlQuery);
        # Procesado de la respuesta
        $htmlResult  = " <div class='d-flex flex-column'> ";
        $htmlResult .= "    <h3>Lista de Ausencias</h3> ";
        $htmlResult .= "    <table class='table '>";
        $htmlResult .= "        <tbody>";
        while ($fila = $sqlResults->fetch_assoc()) {
            $htmlResult .=               "<tr>";
            $htmlResult .=               "<th> Id <td>" . $fila['id'] . "</td>";
            $htmlResult .=               "</tr>";
            $htmlResult .=               "<tr>";
            $htmlResult .=               "<th> Alumno Id<td>" . $fila['id'] . "</td>";
            $htmlResult .=               "</tr>";
            $htmlResult .=               "<tr>";
            $htmlResult .=               "<th> Nombre <td>" . $fila['nombre'] . " " . $fila['apellidos'] . "</td>";
            $htmlResult .=               "</tr>";
            $htmlResult .=               "<tr>";
            $htmlResult .=               "<th> Asignatura Id<td>" . $fila['asignaturaId'] . "</td>";
            $htmlResult .=               "</tr>";
            $htmlResult .=               "<tr>";
            $htmlResult .=               "<th> Nombre Asignatura<td>" . $fila['nombreAsignatura'] . "</td>";
            $htmlResult .=               "</tr>";
            $htmlResult .=               "<tr>";
            $htmlResult .=               "<th> Fecha<td>" . $fila['fecha'] . "</td>";
            $htmlResult .=               "</tr>";
            $htmlResult .=               "<tr>";
            $htmlResult .=               "<th> Justificada<td>" . $fila['justificada'] . "</td>";
            $htmlResult .=               "</tr>";
        }
        $htmlResult .= "        </tbody>";
        $htmlResult .= "    </table>";
        $htmlResult .= " </div>";
        $htmlResult .= "";
        echo $htmlResult;
    } else {
        $rtn = array("id", "3", "error", "faltaAsistenciaId no especificado");
        http_response_code(500);
        print json_encode($rtn);
    }
}
