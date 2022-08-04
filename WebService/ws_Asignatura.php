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
        if(ISSET($_REQUEST['idAsignatura'])){ // COMPRUEBA EXISTENCIA 
            $id = $_REQUEST['idAsignatura'];
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