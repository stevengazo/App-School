<?php

    # RestFull
    $metodo = $_SERVER['REQUEST_METHOD'];

    switch ($metodo) {
        case 'GET': 
            switch ($_REQUEST['tipo']) {
                case 'lista':
                    ListarElementos();
                    break;
                    case 'lastid':
                        getUltimoId();
                    break;    
            }       
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

    function getUltimoId(){
            # CADENA DE CONEXIÓN
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
            # codigo SQL
            $sqlQuery = '
            SELECT id FROM Horario
            order by id desc
            limit 1
            ';               
            # EJECUTA EL CODIGO   
            $sqlResult= $linkConnection->query($sqlQuery);
            #PROCESADO DE RESULTADOS
            while($file = $sqlResult->fetch_assoc()){
                $tmpresult= new stdClass();
                $tmpresult->ultimoId = $file['id'];
                lanzarJson($tmpresult,false,200);
            }  
            exit;    
    }

    /**
     *  Actualiza un elemento
     */
    function UpdateNota(){
        # COMPROBACIONES DE VALORES
        if(ISSET($_REQUEST['idHorario'])){ // COMPRUEBA EXISTENCIA 
            $id = $_REQUEST['idHorario'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "id no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }        
        if(ISSET($_REQUEST['asignatura_id'])){ // COMPRUEBA EXISTENCIA 
            $asignatura_id = $_REQUEST['asignatura_id'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "asignatura_id no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                
        if(ISSET($_REQUEST['dia'])){ // COMPRUEBA EXISTENCIA 
            $dia = $_REQUEST['dia'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "dia no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                
        if(ISSET($_REQUEST['horaInicio'])){ // COMPRUEBA EXISTENCIA 
            $horaInicio = $_REQUEST['horaInicio'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "horaInicio no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;            
        }        
        if(ISSET($_REQUEST['horaFin'])){ // COMPRUEBA EXISTENCIA 
            $horaFin = $_REQUEST['horaFin'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "horaFin no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                        
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
        # CODIGO SQL
        $sqlQuery = " UPDATE HORARIO ";       
        $sqlQuery .= " SET asignatura_id = $asignatura_id, dia = '$dia', horaInicio = '$horaInicio', horaFin = '$horaFin' ";       
        $sqlQuery .= " where id = $id ";               
        #EJECUCIÓN CONSULTA
        $sqlResult = $linkConnection->query($sqlQuery);
        /* RETORNA JSON */             
        header("Content-Type: application/json");
        echo json_encode($sqlResult);   
    }

    function BorrarNota(){
        if(ISSET($_REQUEST['idHorario'])){ // COMPRUEBA EXISTENCIA 
            $id = $_REQUEST['idHorario'];
            # CADENA DE CONEXIÓN
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
            # CODIGO SQL
            $sqlQuery = " DELETE FROM Horario ";   
            $sqlQuery .= " WHERE ID = $id";
            # EJECUTA EL CODIGO   
            $sqlResult= $linkConnection->query($sqlQuery);
            /* RETORNA JSON */             
            header("Content-Type: application/json");
            echo json_encode($sqlResult);                        
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "idHorario no especificado");
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
        if(ISSET($_REQUEST['idHorario'])){ // COMPRUEBA EXISTENCIA 
            $id = $_REQUEST['idHorario'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "idHorario no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }        
        if(ISSET($_REQUEST['asignatura_id'])){ // COMPRUEBA EXISTENCIA 
            $asignatura_id = $_REQUEST['asignatura_id'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "asignatura_id no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                
        if(ISSET($_REQUEST['dia'])){ // COMPRUEBA EXISTENCIA 
            $dia = $_REQUEST['dia'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "dia no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                
        if(ISSET($_REQUEST['horaInicio'])){ // COMPRUEBA EXISTENCIA 
            $horaInicio = $_REQUEST['horaInicio'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "horaInicio no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;            
        }        
        if(ISSET($_REQUEST['horaFin'])){ // COMPRUEBA EXISTENCIA 
            $horaFin = $_REQUEST['horaFin'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "horaFin no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                        
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
        # CODIGO SQL
        $sqlQuery = " INSERT INTO HORARIO ( ID, asignatura_id, dia, horaInicio, horaFin) ";       
        $sqlQuery .= " values ( $id, $asignatura_id , '$dia', '$horaInicio', '$horaFin') ";       
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
        $sqlQuery = " select H.id, H.asignatura_id, A.nombre,  H.dia, H.horaInicio, H.horaFin  from Horario AS H ";   
        $sqlQuery .= " INNER JOIN ASIGNATURA AS A ON H.asignatura_id = A.id ";
        # EJECUCIÓN CODIGO
        $sqlResult = $linkConnection->query($sqlQuery);              
        # PROCESADO DE RESULTADOS
        $arrayResult = array();
        while($file = $sqlResult->fetch_assoc()){
            $ObjectTmp = new stdClass();
            $ObjectTmp->id = $file['id'];
            $ObjectTmp->asignaturaId = $file['asignatura_id'];            
            $ObjectTmp->nombre = $file['nombre'];           
            $ObjectTmp->dia = $file['dia'];                       
            $ObjectTmp->horaInicio = $file['horaInicio'];                       
            $ObjectTmp->horaFin = $file['horaFin'];                       
            array_push($arrayResult, $ObjectTmp);
        }      
        /* RETORNA JSON */             
        lanzarJson($arrayResult,false,200);
    }

    /**
     * Retorna un elemento especifico por el id
     */
    function GetElement(){
        if(ISSET($_REQUEST['idHorario'])){
            $id = $_REQUEST['idHorario'];
            # CADENA DE CONEXIÓN
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
            # codigo SQL
            $sqlQuery = " select H.id, H.asignatura_id, A.nombre,  H.dia, H.horaInicio, H.horaFin  from Horario AS H ";   
            $sqlQuery .= " INNER JOIN ASIGNATURA AS A ON H.asignatura_id = A.id ";
            $sqlQuery .= " where H.id = $id ";
            # EJECUTA EL CODIGO   
            $sqlResult= $linkConnection->query($sqlQuery);
            #PROCESADO DE RESULTADOS
            $arrayResult = null;
            while($file = $sqlResult->fetch_assoc()){
                $arrayTemp = array();
                $arrayTemp['id'] = $file['id'];
                $arrayTemp['asignatura_id'] = $file['asignatura_id'];            
                $arrayTemp['nombre'] = $file['nombre'];           
                $arrayTemp['dia'] = $file['dia'];                       
                $arrayTemp['horaInicio'] = $file['horaInicio'];                       
                $arrayTemp['horaFin'] = $file['horaFin'];                       
                $arrayResult=$arrayTemp;
            }      
            /* RETORNA JSON */             
            lanzarJson($arrayResult,false,200);
        }else{
            $rtn = array("id", "3", "error", "IdHorario no especificado");
            http_response_code(500);
            print json_encode($rtn);
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
    
?>