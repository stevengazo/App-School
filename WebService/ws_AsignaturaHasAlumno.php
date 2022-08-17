<?php

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'VIEW':
        View();
        break;
    case 'PUT':
        UPdate();
        break;
    case 'GET':
        GetAHA();
        break;
    case 'POST':
        InsertAHA();
        break;
    case 'DELETE':
        Delete();
        break;
    default:
        $rtn = array("id", "3", "error", "something wrong happened");
        http_response_code(500);
        print json_encode($rtn);
        break;
}

/**
 * Trae un elemento de la DB
 */
function View()
{
    // Conexión 
    $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
    if (isset($_REQUEST['asigAlum_id'])) { // COMPRUEBA EXISTENCIA 
        $id = $_REQUEST['asigAlum_id'];
        $sqlQuery = " SELECT 	AHS.ID AS id, AHS.asignatura_id,  ASIG.NOMBRE AS nombreAsignatura, AHS.alumno_id, AL.nombre as nombreAlumno, AL.apellidos as apellidosAlumno ";
        $sqlQuery = $sqlQuery . " FROM ASIGNATURA_HAS_ALUMNO AS AHS ";
        $sqlQuery .= " INNER JOIN ALUMNO AS AL ON AHS.ALUMNO_ID = AL.ID ";
        $sqlQuery .= " INNER JOIN ASIGNATURA AS ASIG ON AHS.ASIGNATURA_ID = ASIG.ID ";
        $sqlQuery .= " where AHS.ID = $id ";
        $sqlResult = $linkConnection->query($sqlQuery);
        $arrayResult = array();
        while ($fila = $sqlResult->fetch_assoc()) {
            $arrayTmp = array();
            $arrayTmp['id'] = $fila['id'];
            $arrayTmp['asignatura_id'] = $fila['asignatura_id'];
            $arrayTmp['asignaturaNombre'] = $fila['nombreAsignatura'];
            $arrayTmp['alumno_id'] = $fila['alumno_id'];
            $arrayTmp['alumnoNombre'] = $fila['nombreAlumno'];
            $arrayTmp['alumnoApellidos'] = $fila['apellidosAlumno'];
            /* RETORNA JSON */
            http_response_code(200);
            //header("Content-Type: application/json");
            echo json_encode($arrayTmp);
        }
    } else {
        $rtn = array("id", "3", "error", "asigAlum_id no definido");
        http_response_code(500);
        print json_encode($rtn);
    }
}
/**
 * Trae un arreglo de elementos
 */
function GetAHA()
{
    if (!isset($_REQUEST['tipo'])) {
        $rtn = array("id", "3", "error", "tipo no definido");
        http_response_code(500);
        print json_encode($rtn);
        exit;
    } else {
        $tipo = $_REQUEST['tipo'];
        // Conexión 
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        switch ($tipo) {
            case 'HTML':
                $sqlQuery = " select 	AsigAlumn.id, AsigAlumn.asignatura_id, 	ASG.nombre as asignaturaNombre,  AsigAlumn.alumno_id, AL.nombre as alumnoNombre, Al.apellidos as alumnoApellidos     ";
                $sqlQuery = $sqlQuery . " from asignatura_has_alumno as AsigAlumn ";
                $sqlQuery = $sqlQuery . " inner join asignatura as ASG  on AsigAlumn.asignatura_id = ASG.id ";
                $sqlQuery = $sqlQuery . " inner join alumno as AL  on AsigAlumn.alumno_id = AL.id ";
                $sqlQuery = $sqlQuery . " group by AsigAlumn.id ";
                $sqlResult = $linkConnection->query($sqlQuery);
                $arrayResult = array();
                $htmlElements = '
                                <div>
                                    <div>
                                        <h4>
                                            Lista de Alumnos y Asignaturas
                                        </h4>
                                        <p>
                                            A continuación se muestran los alumnos matriculados en las asignaturas existentes.
                                        </p>        
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                N° Registro
                                            </th>
                                            <th>
                                                Asignatura
                                            </th>
                                            <th>
                                                Estudiante
                                            </th>
                                            <th>
                                                Accion
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                while ($fila = $sqlResult->fetch_assoc()) {
                    $htmlElements .= '  <tr>';
                    $htmlElements .= '  <td>' . $fila['id'] . '</td>';
                    $htmlElements .= '  <td>' . $fila['asignaturaNombre'] . '</td>';
                    $htmlElements .= '  <td>' . $fila['alumnoNombre'] . $fila['alumnoApellidos'] . '</td>';
                    $htmlElements .= " <td onclick='ViewAsignaturaHasAlumno(" . $fila['id'] . ")' class='btn btn-sm text-dark btn-info mr-1' > <i class='bi bi-info-circle'></i></td>";
                    $htmlElements .= " <td onclick='PostDeleteAsignaturaHasAlumno(" . $fila['id'] . ")' class='btn btn-sm text-dark btn-danger' > <i class='bi bi-trash3'></i> </td>";
                    $htmlElements .= '  </tr>';
                }
                $htmlElements .= '
                                </tbody> 
                            </table> ';
                http_response_code(200);
                echo $htmlElements;
                break;
            case 'JSON':
                if (!isset($_REQUEST['dato'])) {
                    $rtn = array("id", "3", "error", "dato no definido");
                    http_response_code(500);
                    print json_encode($rtn);
                    exit;
                } else {
                    $dato = $_REQUEST['dato'];
                    switch ($dato) {
                        case 'ultimoId':
                            $sqlQuery = " SELECT * FROM ASIGNATURA_HAS_ALUMNO ORDER BY ID DESC LIMIT 1 ";                            
                            $sqlResult = $linkConnection->query($sqlQuery);                        
                            while ($fila = $sqlResult->fetch_assoc()) {
                                $temporalObjecto = new stdClass();
                                $temporalObjecto->id = $fila['id'];                                
                                http_response_code(200);
                                print json_encode($temporalObjecto);
                            }
                            exit;
                            break;
                        case 'lista':
                            $sqlQuery = " select 	AsigAlumn.id, AsigAlumn.asignatura_id, 	ASG.nombre as asignaturaNombre,  AsigAlumn.alumno_id, AL.nombre as alumnoNombre, Al.apellidos as alumnoApellidos     ";
                                $sqlQuery = $sqlQuery . " from asignatura_has_alumno as AsigAlumn ";
                                $sqlQuery = $sqlQuery . " inner join asignatura as ASG  on AsigAlumn.asignatura_id = ASG.id ";
                                $sqlQuery = $sqlQuery . " inner join alumno as AL  on AsigAlumn.alumno_id = AL.id ";
                                $sqlQuery = $sqlQuery . " group by AsigAlumn.id ";
                            $sqlResult = $linkConnection->query($sqlQuery);
                            $arrayResult = array();
                            while ($fila = $sqlResult->fetch_assoc()) {
                                $temporalObjecto = new stdClass();
                                $temporalObjecto->id = $fila['id'];
                                $temporalObjecto->asignatura_id = $fila['asignatura_id'];
                                $temporalObjecto->asignaturaNombre = $fila['asignaturaNombre'];
                                $temporalObjecto->alumno_id = $fila['alumno_id'];
                                $temporalObjecto->alumnoNombre = $fila['alumnoNombre'];
                                array_push($arrayResult, $temporalObjecto);
                            }
                            http_response_code(200);
                            print json_encode($arrayResult);
                            exit;
                            break;
                        default:
                            $rtn = array("id", "3", "error", "dato no valido");
                            http_response_code(500);
                            print json_encode($rtn);
                            exit;
                            break;
                    }
                }
                break;
            default:
                $rtn = array("id", "3", "error", "tipo no es valido");
                http_response_code(500);
                print json_encode($rtn);
                exit;
                break;
        }
    }
}
/**
 * Borra un elemento de la DB
 */
function Delete()
{
    try {
        // Conexión 
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        if (isset($_REQUEST['asigAlum_id'])) {
            $id = $_REQUEST['asigAlum_id'];
        }else{
            lanzarJson("asigAlum_id no especificado",true,500);
            exit;
        }
        $sqlQuery = " DELETE FROM ASIGNATURA_HAS_ALUMNO ";
        $sqlQuery = $sqlQuery . " WHERE ID = $id ";
        $sqlResult = $linkConnection->query($sqlQuery);
        echo $sqlResult -> error;
        /* RETORNA JSON */
        lanzarJson(true, false,200);
    } catch (\Throwable $th) {
        lanzarJson("El registro presenta dependencias", true,500);
    }
}

/**
 * Actualiza un elemento de la DB
 */
function UPdate()
{
    try {
        // Conexión 
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        if (isset($_REQUEST['asigAlum_id'])) {
            $id = $_REQUEST['asigAlum_id'];
        }
        if (isset($_REQUEST['asignatura_id'])) {
            $asignatura_id = $_REQUEST['asignatura_id'];
        }
        if (isset($_REQUEST['alumno_id'])) {
            $alumno_id = $_REQUEST['alumno_id'];
        }
        $sqlQuery = " UPDATE ASIGNATURA_HAS_ALUMNO ";
        $sqlQuery = $sqlQuery . " SET ASIGNATURA_ID = $asignatura_id , ALUMNO_ID= $alumno_id ";
        $sqlQuery = $sqlQuery . " WHERE ID = $id ";
        $result = $linkConnection->query($sqlQuery);
        /* RETORNA JSON */
        header("Content-Type: application/json");
        echo json_encode($result);
    } catch (\Throwable $th) {
        $rtn = array("id", "3", "error", "something wrong happened");
        http_response_code(500);
        print json_encode($rtn);
    }
}
/**
 * inserta un elemento en la DB
 */
function InsertAHA()
{
    try {
        // Conexión 
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        if (isset($_REQUEST['asigAlum_id'])) {
            $id = $_REQUEST['asigAlum_id'];
        }else{
            lanzarJson("asigAlumn_id no especificado",true,500);
            exit;
        }
        if (isset($_REQUEST['asignatura_id'])) {
            $asignatura_id = $_REQUEST['asignatura_id'];        
        }else{
            lanzarJson("asignatura_id no especificado",true,500);
            exit;
        }
        if (isset($_REQUEST['alumno_id'])) {
            $alumno_id = $_REQUEST['alumno_id'];
        }else{
            lanzarJson("alumno_id no especificado",true,500);
            exit;
        }
        $sqlQuery = " INSERT INTO ASIGNATURA_HAS_ALUMNO(ID, asignatura_id, alumno_id) ";
        $sqlQuery = $sqlQuery . " values( $id , $asignatura_id , $alumno_id) ";
        $sqlResult = $linkConnection->query($sqlQuery);
        /* RETORNA JSON */        
        lanzarJson(true,false,200);
    } catch (\Throwable $th) {
        lanzarJson("Error en la funcion...",true,500);
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