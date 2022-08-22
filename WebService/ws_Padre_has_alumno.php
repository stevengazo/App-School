<?php

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'VIEW':
        ViewPadreHasAlumno();
        break;
    case 'PUT':
        UpdatePadreHasAlumno();
        break;
    case 'GET':
        if (isset($_REQUEST['tipo'])) { // COMPRUEBA EXISTENCIA 
            switch ($_REQUEST['tipo']) {
                case 'lista':
                    GetPadreHasAlumno();
                    break;
                case 'ultimoid':
                    ultimoId();
                    break;                
                default:
                    break;
            }
        } else {
            // id no definido
            $rtn = array("id", "3", "error", "tipo no especificado");
            
            exit;
        }

        break;
    case 'POST':
        AddPadreHasAlumno();
        break;
    case 'DELETE':
        DeletePadreHasAlumno();
        break;
    default:
        lanzarJson("Metodo Http no implementado", true, 500);
        break;
}


function ultimoId()
{    
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        $sqlQuery = '
        select id 
        from padre_has_alumno
        order by id desc
        limit 1
         ';
        $sqlResult = $linkConnection->query($sqlQuery);
        $ObjectoTemporal = new stdClass();
        while ($fila = $sqlResult->fetch_assoc()) {
            $ObjectoTemporal->lastId = $fila['id'];
        }
        # Implementar funcion para agregar hijos
        lanzarJson($ObjectoTemporal, false, 200);
        exit;
    
}

function ViewPadreHasAlumno()
{
    if (!isset($_REQUEST['id'])) {
        lanzarJson("id no definido", true, 500);
    } else {
        $id = $_REQUEST['id'];
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        $sqlQuery = '
        select 
            PHA.ID AS id, 
            P.id as padreid,
            P.nombre as padreNombre,
            P.apellidos as padreApellidos,
            A.id as alumnoId,
            A.nombre as alumnoNombre,
            A.apellidos as alumnoApellidos
        from padre_has_alumno as PHA
        inner join alumno AS A on A.id = PHA.alumno_id
        inner join padre  AS P ON P.id =  PHA.padre_id
        where PHA.ID =' . $id;
        $sqlResult = $linkConnection->query($sqlQuery);
        $ObjectoTemporal = new stdClass();
        while ($fila = $sqlResult->fetch_assoc()) {
            $ObjectoTemporal->id = $fila['id'];
            $ObjectoTemporal->padreId = $fila['padreid'];
            $ObjectoTemporal->padreNombre = $fila['padreNombre'] . ' ' . $fila['padreApellidos'];
            $ObjectoTemporal->alumnoId = $fila['alumnoId'];
            $ObjectoTemporal->alumnoNombre = $fila['alumnoNombre'] . ' ' . $fila['alumnoApellidos'];
        }
        # Implementar funcion para agregar hijos
        lanzarJson($ObjectoTemporal, false, 200);
        exit;
    }
}

function DeletePadreHasAlumno()
{
    if (!isset($_REQUEST['id'])) {
        lanzarJson("id no definido", true, 500);
        exit;
    }
    try {
        $id = $_REQUEST['id'];
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        $sqlQuery = '                    
            DELETE FROM PADRE_HAS_ALUMNO
            WHERE ID =' . $id;
        $sqlResult = $linkConnection->query($sqlQuery);
        lanzarJson($sqlResult, false, 200);
        exit;
    } catch (Exception $e) {
        lanzarJson($e->getMessage(), true, 500);
        exit;
    }
}

function UpdatePadreHasAlumno()
{
    if (!isset($_REQUEST['id'])) {
        lanzarJson("id no definido", true, 500);
        exit;
    }
    if (!isset($_REQUEST['idPadre'])) {
        lanzarJson("idPadre no definido", true, 500);
        exit;
    }
    if (!isset($_REQUEST['idAlumno'])) {
        lanzarJson("idAlumno no definido", true, 500);
        exit;
    }
    try {
        $id = $_REQUEST['id'];
        $idPadre = $_REQUEST['idPadre'];
        $idAlumno = $_REQUEST['idAlumno'];
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        $sqlQuery = '
        UPDATE PADRE_HAS_ALUMNO
        SET
            PADRE_ID = ' . $idPadre . ',
            ALUMNO_ID = ' . $idAlumno . '
        where ID =' . $id;
        $sqlResult = $linkConnection->query($sqlQuery);
        lanzarJson($sqlResult, false, 200);
        exit;
    } catch (Exception $e) {
        lanzarJson("Error interno: " . $e->getMessage(), true, 500);
        exit;
    }
}

function AddPadreHasAlumno()
{
    if (!isset($_REQUEST['id'])) {
        lanzarJson("id no definido", true, 500);
        exit;
    }
    if (!isset($_REQUEST['idPadre'])) {
        lanzarJson("idPadre no definido", true, 500);
        exit;
    }
    if (!isset($_REQUEST['idAlumno'])) {
        lanzarJson("idAlumno no definido", true, 500);
        exit;
    }
    try {
        $id = $_REQUEST['id'];
        $idPadre = $_REQUEST['idPadre'];
        $idAlumno = $_REQUEST['idAlumno'];
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        $sqlQuery = '
        INSERT INTO PADRE_HAS_ALUMNO(ID,padre_id,alumno_id)
        VALUES		('.$id.', '.$idPadre.','.$idAlumno.')
        ';
        $sqlResult = $linkConnection->query($sqlQuery);
        lanzarJson($sqlResult, false, 200);
        exit;
    } catch (Exception $e) {
        lanzarJson("Error interno: " . $e->getMessage(), true, 500);
        exit;
    }
}
function GetPadreHasAlumno()
{
    if (!isset($_REQUEST['tipo'])) {
        lanzarJson("tipo no definido", true, 500);
    } else {
        $tipo = $_REQUEST['tipo'];
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        $sqlQuery = '';
        switch ($tipo) {
            case 'lista':
                $sqlQuery = '                 
                    select 
                        PHA.ID AS id, 
                        P.id as padreid,
                        P.nombre as padreNombre,
                        P.apellidos as padreApellidos,
                        A.id as alumnoId,
                        A.nombre as alumnoNombre,
                        A.apellidos as alumnoApellidos
                    from padre_has_alumno as PHA
                    inner join alumno AS A on A.id = PHA.alumno_id
                    inner join padre  AS P ON P.id =  PHA.padre_id        
                ';
                $sqlResult = $linkConnection->query($sqlQuery);
                $arrayObjectos = array();
                while ($fila = $sqlResult->fetch_assoc()) {
                    $ObjectoTemporal = new stdClass();
                    $ObjectoTemporal->id = $fila['id'];
                    $ObjectoTemporal->padreId = $fila['padreid'];
                    $ObjectoTemporal->padreNombre = $fila['padreNombre'] . ' ' . $fila['padreApellidos'];
                    $ObjectoTemporal->alumnoId = $fila['alumnoId'];
                    $ObjectoTemporal->alumnoNombre = $fila['alumnoNombre'] . ' ' . $fila['alumnoApellidos'];
                    array_push($arrayObjectos, $ObjectoTemporal);
                }
                lanzarJson($arrayObjectos, false, 200);
                exit;
                break;
            case 'elemento':
                # code...
                break;
            default:
                lanzarJson("tipo no especificado (lista, elemento)", true, 404);
                exit;
                break;
        }
    }
}

/**
 * Lanza una respuesta en formato JSON
 */
function lanzarJson($DataCodificar, $error = true, $CodigoError)
{
    if ($error) {
        $rtn = array("id", "1", "error", $DataCodificar);
        http_response_code($CodigoError);
        print json_encode($rtn);
    } else {
        http_response_code($CodigoError);
        print json_encode($DataCodificar);
    }
}
