<?php

    $metodo = $_SERVER['REQUEST_METHOD'];


    switch ($metodo) {
        case 'GET':        
            ListarElementos();
            break;
        case 'POST':
            InsertarElemento();
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
            $rtn = array("id", "3", "error", "Algo paso mal...");
            http_response_code(500);
            print json_encode($rtn);
            break;
    }

    function UpdateNota(){
        if(ISSET($_REQUEST['idNota'])){
            $id = $_REQUEST['idNota'];
        }
        if(ISSET($_REQUEST['asignaturaHasAlumnoId'])){
            $asignaturaHasAlumnoId = $_REQUEST['asignaturaHasAlumnoId'];
        }
        if(ISSET($_REQUEST['trimestre'])){
            $trimestre = $_REQUEST['trimestre'];
        }
        if(ISSET($_REQUEST['nota'])){
            $nota = $_REQUEST['nota'];
        }      
        $sqlQuery = " UPDATE Nota ";
        $sqlQuery .= " SET   asignatura_has_alumno_id = $asignaturaHasAlumnoId , trimestre = $trimestre, nota = $nota"; 
        $sqlQuery .= " WHERE  id= $id ";
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");   
        $sqlResult = $linkConnection->query($sqlQuery);

    }

    function BorrarNota(){
        if(ISSET($_REQUEST['idNota'])){
            $id = $_REQUEST['idNota'];
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");   
            $sqlQuery = " DELETE FROM Nota where id = $id";                           
            $sqlResult = $linkConnection->query($sqlQuery);            
        }      
    }


    /**
     * Insertar un nuevo elemento mediante un llamado a la api
     */
    function InsertarElemento(){
        if(ISSET($_REQUEST['idNota'])){
            $id = $_REQUEST['idNota'];

        }
        if(ISSET($_REQUEST['asignaturaHasAlumnoId'])){
            $asignaturaHasAlumnoId = $_REQUEST['asignaturaHasAlumnoId'];

        }
        if(ISSET($_REQUEST['trimestre'])){
            $trimestre = $_REQUEST['trimestre'];

        }
        if(ISSET($_REQUEST['nota'])){
            $nota = $_REQUEST['nota'];

        }    
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");   
        $sqlQuery = " INSERT INTO nota(id, asignatura_has_alumno_id,trimestre, nota) ";
        $sqlQuery = $sqlQuery." values ($id,$asignaturaHasAlumnoId,$trimestre,$nota) ";                                   
        $sqlResult = $linkConnection->query($sqlQuery);      
    }

    /**
     * Descripción: lista todos los elementos existentes
     */
    function ListarElementos(){
        $linkConnection =  mysqli_connect("localhost","root","","testingdb"); 
        $sqlQuery = "select N.id, trimestre, nota, A.id as alumnoId , A.nombre, A.apellidos, ASG.id as asignaturaId, ASG.nombre as asignaturaNombre from nota as N ";
        $sqlQuery = $sqlQuery." inner join asignatura_has_alumno as AA on N.asignatura_has_alumno_id = AA.id ";
        $sqlQuery = $sqlQuery." inner join alumno as A on AA.alumno_id = A.id ";
        $sqlQuery = $sqlQuery." inner join asignatura as ASG on AA.asignatura_id = ASG.id; ";                                
        $sqlResult = $linkConnection->query($sqlQuery);
        $arrayResult = array();
        while($file = $sqlResult->fetch_assoc()){
            $arrayTemp = array();
            $arrayTemp['id'] = $file['id'];
            $arrayTemp['trimestre'] = $file['trimestre'];
            $arrayTemp['nota'] = $file['nota'];
            $arrayTemp['alumnoId'] = $file['alumnoId'];
            $arrayTemp['nombre'] = $file['nombre'];
            $arrayTemp['apellidos'] = $file['apellidos'];
            $arrayTemp['asignaturaId'] = $file['asignaturaId'];
            $arrayTemp['asignaturaNombre'] = $file['asignaturaNombre'];

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
        if(ISSET($_REQUEST['idNota'])){
            $id = $_REQUEST['idNota'];

        }
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
        $sqlQuery = "select N.id, trimestre, nota,AA.id as asignatura_has_alumno_id  , A.id as alumnoId , A.nombre, A.apellidos, ASG.id as asignaturaId, ASG.nombre as asignaturaNombre from nota as N ";
        $sqlQuery = $sqlQuery." inner join asignatura_has_alumno as AA on N.asignatura_has_alumno_id = AA.id ";
        $sqlQuery = $sqlQuery." inner join alumno as A on AA.alumno_id = A.id ";
        $sqlQuery = $sqlQuery." inner join asignatura as ASG on AA.asignatura_id = ASG.id ";                                
        $sqlQuery = $sqlQuery." where N.id = $id";
        $sqlResult= $linkConnection->query($sqlQuery);
        $arrayResult = array();
        while($file = $sqlResult->fetch_assoc()){
            $arrayTemp = array();
            $arrayTemp['id'] = $file['id'];
            $arrayTemp['trimestre'] = $file['trimestre'];
            $arrayTemp['nota'] = $file['nota'];
            $arrayTemp['alumnoId'] = $file['alumnoId'];
            $arrayTemp['asignatura_has_alumno_id']= $file['asignatura_has_alumno_id'];
            $arrayTemp['nombre'] = $file['nombre'];
            $arrayTemp['apellidos'] = $file['apellidos'];
            $arrayTemp['asignaturaId'] = $file['asignaturaId'];
            $arrayTemp['asignaturaNombre'] = $file['asignaturaNombre'];
            $arrayResult[] =$arrayTemp;
        }
        /* RETORNA JSON */             
        header("Content-Type: application/json");
        echo json_encode($arrayResult);
        exit;
    }
    
?>