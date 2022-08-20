<?php

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
            $rtn = array("id", "3", "error", "Algo paso mal...");
            http_response_code(500);
            print json_encode($rtn);
            break;
    }

    function UpdateNota(){
        if(ISSET($_REQUEST['idNota'])){
            $id = $_REQUEST['idNota'];
        }else{
            $rtn = array("id", "3", "error", "idNota no definido");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['asignaturaHasAlumnoId'])){
            $asignaturaHasAlumnoId = $_REQUEST['asignaturaHasAlumnoId'];
        }else{
            $rtn = array("id", "3", "error", "asignaturaHasAlumnoId no definida");
            http_response_code(500);
            print json_encode($rtn);
            exit;            
        }
        if(ISSET($_REQUEST['trimestre'])){
            $trimestre = $_REQUEST['trimestre'];
        }else{
            $rtn = array("id", "3", "error", "trimestre no definido");
            http_response_code(500);
            print json_encode($rtn);
            exit;            
        }
        if(ISSET($_REQUEST['nota'])){
            $nota = $_REQUEST['nota'];
        }   else{
            $rtn = array("id", "3", "error", "nota no definida");
            http_response_code(500);
            print json_encode($rtn);
            exit;            
        }   
        $sqlQuery = " UPDATE Nota ";
        $sqlQuery .= " SET   asignatura_has_alumno_id = $asignaturaHasAlumnoId , trimestre = $trimestre, nota = $nota"; 
        $sqlQuery .= " WHERE  id= $id ";
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");   
        $sqlResult = $linkConnection->query($sqlQuery);
        http_response_code(200);
        echo true;
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

        }else{
            $rtn = array("id", "3", "error", "idNota no definido");
            http_response_code(500);
            print json_encode($rtn);            
            exit;
        }
        if(ISSET($_REQUEST['asignaturaHasAlumnoId'])){
            $asignaturaHasAlumnoId = $_REQUEST['asignaturaHasAlumnoId'];
        }else{
            $rtn = array("id", "3", "error", "asignaturaHasAlumnoId no definido");
            http_response_code(500);
            print json_encode($rtn);                        
            exit;            
        }
        if(ISSET($_REQUEST['trimestre'])){
            $trimestre = $_REQUEST['trimestre'];
        }
        else{
            $rtn = array("id", "3", "error", "trimestre no definido");
            http_response_code(500);
            print json_encode($rtn);            
            exit;            
        }
        if(ISSET($_REQUEST['nota'])){
            $nota = $_REQUEST['nota'];
        }    else{
            $rtn = array("id", "3", "error", "nota no definido");
            http_response_code(500);
            print json_encode($rtn);            
            exit;                        
        }
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");   
        $sqlQuery = " INSERT INTO nota(id, asignatura_has_alumno_id,trimestre, nota) ";
        $sqlQuery = $sqlQuery." values ($id,$asignaturaHasAlumnoId,$trimestre,$nota) ";                                   
        $sqlResult = $linkConnection->query($sqlQuery);    
        http_response_code(200); 
                
    }

    /**
     * Descripción: lista todos los elementos existentes
     */
    function ListarElementos(){
        if (isset($_REQUEST['type'])) {
            $type = $_REQUEST['type'];
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
            switch ($type) {
                case 'lastId':
                    $sqlQuery = " SELECT id from nota order by id desc limit 1 ";
                    $sqlResult= $linkConnection->query($sqlQuery);
                    while($file = $sqlResult->fetch_assoc()){
                        $tmpElement = new stdClass();
                        $tmpElement->id= $file['id'];
                        http_response_code(200);
                        print json_encode($tmpElement);
                        exit;
                    }                
                    break;
                case 'listbyAlumnoId':

                    
                    break;
                case 'elements':
                    $sqlQuery = "select N.id, trimestre, nota, A.id as alumnoId , A.nombre, A.apellidos, ASG.id as asignaturaId, ASG.nombre as asignaturaNombre from nota as N ";
                    $sqlQuery = $sqlQuery." inner join asignatura_has_alumno as AA on N.asignatura_has_alumno_id = AA.id ";
                    $sqlQuery = $sqlQuery." inner join alumno as A on AA.alumno_id = A.id ";
                    $sqlQuery = $sqlQuery." inner join asignatura as ASG on AA.asignatura_id = ASG.id ";                                
                    $sqlQuery = $sqlQuery." order by A.apellidos asc ";                                                    
                    $sqlResult = $linkConnection->query($sqlQuery);
                    $arrayResult = array();
                    $HtmlResults = '
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
                                    Trimestre
                                </th>
                                <th>
                                    Nota
                                </th>
                                <th>
                                    Accion
                                </th>
                            </tr>
                        </thead>
                        <tbody>                
                    ';  
                    while($file = $sqlResult->fetch_assoc()){
                        $HtmlResults .=" <tr>";
                        $HtmlResults .=" <td>".$file['id']." </td>";
                        $HtmlResults .=" <td>".$file['trimestre']." </td>";
                        $HtmlResults .=" <td>".$file['nota']." </td>";
                        $HtmlResults .=" <td>".$file['alumnoId']." </td>";
                        $HtmlResults .=" <td>".$file['nombre']." </td>";
                        $HtmlResults .=" <td>".$file['apellidos']." </td>";
                        $HtmlResults .=" <td>".$file['asignaturaId']." </td>";
                        $HtmlResults .=" <td>".$file['asignaturaNombre']." </td>";   
                        $HtmlResults .= ' <td onclick="ViewNota('.$file['id'].')" class="btn btn-sm text-dark btn-info mr-1" > <i class="bi bi-info-circle"></i></td>';
                        $HtmlResults .= ' <td onclick="GetUpdateNota('.$file['id'].')" class="btn btn-sm text-dark btn-primary" > <i class="bi bi-pencil-square"></i> </td>';
                        $HtmlResults .= ' <td onclick="GetDeleteNota('.$file['id'].')" class="btn btn-sm text-dark btn-danger" > <i class="bi bi-trash3"></i> </td>';        
                        $HtmlResults .=" </tr>";
                    } 
                    $HtmlResults .= '            
                        </tbody>  
                    ';            
                    echo $HtmlResults;
                    break;                
                default:
                        $rtn = array("id", "3", "error", "type no es valido. Type = " . $type);
                        http_response_code(500);
                        print json_encode($rtn);            
                        break;
            }
        }else{
            $rtn = array("id", "3", "error", "type no definido");
            http_response_code(500);
            print json_encode($rtn);            
            
        }        
    }

/**
 * Retorna un elemento especifico por el id
 */
    function GetElement(){                 
        if(ISSET($_REQUEST['idNota'])){
            $id = $_REQUEST['idNota'];
            $sqlQuery = "select N.id, trimestre, nota,AA.id as asignatura_has_alumno_id  , A.id as alumnoId , A.nombre, A.apellidos, ASG.id as asignaturaId, ASG.nombre as asignaturaNombre from nota as N ";
            $sqlQuery = $sqlQuery." inner join asignatura_has_alumno as AA on N.asignatura_has_alumno_id = AA.id ";
            $sqlQuery = $sqlQuery." inner join alumno as A on AA.alumno_id = A.id ";
            $sqlQuery = $sqlQuery." inner join asignatura as ASG on AA.asignatura_id = ASG.id ";                                
            $sqlQuery = $sqlQuery." where N.id = $id";
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");                        
            $sqlResult= $linkConnection->query($sqlQuery);
            $arrayResult = null;
            while($file = $sqlResult->fetch_assoc()){
                $arrayResult = array();
                $arrayResult['id'] = $file['id'];
                $arrayResult['trimestre'] = $file['trimestre'];
                $arrayResult['nota'] = $file['nota'];
                $arrayResult['alumnoId'] = $file['alumnoId'];
                $arrayResult['asignatura_has_alumno_id']= $file['asignatura_has_alumno_id'];
                $arrayResult['nombre'] = $file['nombre'];
                $arrayResult['apellidos'] = $file['apellidos'];
                $arrayResult['asignaturaId'] = $file['asignaturaId'];
                $arrayResult['asignaturaNombre'] = $file['asignaturaNombre'];
            }
            /* RETORNA JSON */             
            http_response_code(200);
            echo json_encode($arrayResult);
            exit;
        }else{
            $rtn = array("id", "3", "error", "idNota no definido");
            http_response_code(500);
            print json_encode($rtn);            
            exit;
        }

        
    }
    
?>