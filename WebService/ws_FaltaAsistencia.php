<?php

    # RestFull
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
    function UpdateNota(){
        # CADENA DE CONEXIÓN
        $flag= true;
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");   
        # VALIDACIONES          
        if(isset($_REQUEST['faltaAsistenciaId'])){
            $id = $_REQUEST['faltaAsistenciaId'];
        }else{
            $rtn = array("id", "3", "error", "faltaAsistenciaId no especificado");
            http_response_code(500);
            print json_encode($rtn);
            $flag = false;
            exit;                   
        }
        if(isset($_REQUEST['alumno_id'])){
            $alumno_id = $_REQUEST['alumno_id'];
        }else{
            $rtn = array("id", "3", "error", "alumno_id no especificado");
            http_response_code(500);
            print json_encode($rtn);
            $flag = false;      
            exit;                         
        }
        if(isset($_REQUEST['asignatura_id'])){
            $asignatura_id = $_REQUEST['asignatura_id'];
        }else{
            $rtn = array("id", "3", "error", "asignatura_id no especificado");
            http_response_code(500);
            print json_encode($rtn);
            $flag = false;     
            exit;       
        }
        if(isset($_REQUEST['fecha'])){
            $fecha = $_REQUEST['fecha'];
        }else{
            $rtn = array("id", "3", "error", "fecha no especificado");
            http_response_code(500);
            print json_encode($rtn);
            $flag = false;          
            exit;       
        }
        if(isset($_REQUEST['justificada'])){
            $justificada = $_REQUEST['justificada'];
        }else{
            $rtn = array("id", "3", "error", "justificada no especificado");
            http_response_code(500);
            print json_encode($rtn);
            $flag = false;
            exit;       
        }
        if($flag){
            # CODIGO SQL
            $sqlQuery = "UPDATE falta_asistencia  ";
            $sqlQuery = $sqlQuery." set  alumno_id = $alumno_id, asignatura_id = $asignatura_id, fecha = '$fecha', justificada = '$justificada'";
            $sqlQuery = $sqlQuery." WHERE id = $id;";
            $sqlResults = $linkConnection->query($sqlQuery);
            /* RETORNA JSON */             
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($sqlResults);    
        }
        
    }

    function BorrarNota(){
        # CADENA DE CONEXIÓN
        $flag = TRUE;
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");    
        # VALIDACIONES          
        if(isset($_REQUEST['faltaAsistenciaId'])){
            $id = $_REQUEST['faltaAsistenciaId'];
        }else{
            $rtn = array("id", "3", "error", "faltaAsistenciaId no especificado");
            http_response_code(500);
            print json_encode($rtn);
            $flag = false;
            exit;
        }
        if($flag){
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
    function InsertarElemento(){
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            

        # Validaciones        
        if(isset($_REQUEST['faltaAsistenciaId'])){
            $id = $_REQUEST['faltaAsistenciaId'];
        }else{
            $rtn = array("id", "3", "error", "faltaAsistenciaId no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(isset($_REQUEST['alumno_id'])){
            $alumno_id = $_REQUEST['alumno_id'];
        }else{
            $rtn = array("id", "3", "error", "faltaAsistenciaId no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(isset($_REQUEST['asignatura_id'])){
            $asignatura_id = $_REQUEST['asignatura_id'];
        }else{
            $rtn = array("id", "3", "error", "faltaAsistenciaId no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(isset($_REQUEST['fecha'])){
            $fecha = $_REQUEST['fecha'];
        }else{
            $rtn = array("id", "3", "error", "fecha no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(isset($_REQUEST['justificada'])){
            $justificada = $_REQUEST['justificada'];
        }else{
            $rtn = array("id", "3", "error", "justificada no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        # CODIGO SQL
        $sqlQuery = "INSERT INTO falta_asistencia( id, alumno_id,asignatura_id, fecha, justificada) ";
        $sqlQuery .= " values ($id, 	$alumno_id, $asignatura_id, '$fecha', '$justificada'	);";
        $sqlResults = $linkConnection->query($sqlQuery);

        /* RETORNA JSON */             
        header("Content-Type: application/json");
        echo json_encode($sqlResults);           
    }

    /**
     * Descripción: lista todos los elementos existentes
     */
    function ListarElementos(){
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
        # CODIGO SQL
        $sqlQuery = "select falta_asistencia.id, alumno.nombre, alumno.apellidos, asignatura.nombre as nombreAsignatura  , fecha, justificada from falta_asistencia";
            $sqlQuery = $sqlQuery." inner join alumno on alumno.id = falta_asistencia.alumno_id ";
            $sqlQuery = $sqlQuery." inner join asignatura on falta_asistencia.asignatura_id = asignatura.id";
        $sqlResults = $linkConnection->query($sqlQuery);
        # Procesado de la respuesta
        $arrayResult = array();
        while($fila = $sqlResults->fetch_assoc()){
            $arrayTmp= array();
            $arrayTmp['id'] = $fila['id'];
            $arrayTmp['nombre'] = $fila['nombre'];
            $arrayTmp['apellidos'] = $fila['apellidos'];
            $arrayTmp['asignatura'] = $fila['nombreAsignatura'];
            $arrayTmp['fecha'] = $fila['fecha'];
            $arrayTmp['justificada'] = $fila['justificada'];
            $arrayResult[]= $arrayTmp;
        }
        /* RETORNA JSON */             
        header("Content-Type: application/json");
        echo json_encode($arrayResult);   
    }

    /**
     * Retorna un elemento especifico por el id
     */
    function GetElement(){
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
        # CODIGO SQL
        $sqlQuery = " ";    
        if(isset($_REQUEST['faltaAsistenciaId'])){
            $id = $_REQUEST['faltaAsistenciaId'];
            $sqlQuery = "select falta_asistencia.id, alumno.id as alumnoId, asignatura.id as asignaturaId, alumno.nombre, alumno.apellidos, asignatura.nombre as nombreAsignatura , fecha, justificada from falta_asistencia";
            $sqlQuery = $sqlQuery." inner join alumno on alumno.id = falta_asistencia.alumno_id  ";
            $sqlQuery = $sqlQuery." inner join asignatura on falta_asistencia.asignatura_id = asignatura.id ";
            $sqlQuery = $sqlQuery." where falta_asistencia.id = $id ";
            $sqlResults = $linkConnection->query($sqlQuery);
            # Procesado de la respuesta
            $arrayResult = array();
            while($fila = $sqlResults->fetch_assoc()){
                $arrayTmp= array();
                $arrayTmp['id'] = $fila['id'];
                $arrayTmp['alumno_id'] = $fila['alumnoId'];
                $arrayTmp['asignatura_id'] = $fila['asignaturaId'];
                $arrayTmp['nombre'] = $fila['nombre'];
                $arrayTmp['apellidos'] = $fila['apellidos'];
                $arrayTmp['asignatura'] = $fila['nombreAsignatura'];
                $arrayTmp['fecha'] = $fila['fecha'];
                $arrayTmp['justificada'] = $fila['justificada'];
                $arrayResult[]= $arrayTmp;
            }
            /* RETORNA JSON */             
            header("Content-Type: application/json");
            echo json_encode($arrayResult);   
        }else{
            $rtn = array("id", "3", "error", "faltaAsistenciaId no especificado");
            http_response_code(500);
            print json_encode($rtn);
        }
    }
    
?>