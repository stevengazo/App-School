<?php

    # RestFull
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
    function UpdateNota(){
        # validación de existencia Id
        if(ISSET($_REQUEST['idNivel'])){
            $id = $_REQUEST['idNivel'];
        }else{
            # No se especifico el id
            $rtn = array("id", "3", "error", "idNivel no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }        
        # validación de existencia Nivel
        if(ISSET($_REQUEST['nivel'])){
            $nivel = $_REQUEST['nivel'];
        }else{
            # No se especifico el nivel
            $rtn = array("id", "3", "error", "nivel no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                
        # validación de existencia aula
        if(ISSET($_REQUEST['aula'])){
            $aula = $_REQUEST['aula'];
        }else{
            # No se especifico el aula
            $rtn = array("id", "3", "error", "aula no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                        
        # validación de existencia curso
        if(ISSET($_REQUEST['curso'])){
            $curso = $_REQUEST['curso'];
        }else{
            # No se especifico el curso
            $rtn = array("id", "3", "error", "curso no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                        
        # CADENA DE CONEXIÓN   
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
        # CODIGO SQL
        $sqlQuery = " UPDATE Nivel  ";                
        $sqlQuery .= " Set nivel = '$nivel', curso = '$curso', aula = '$aula' ";
        $sqlQuery .= " where id = $id ";
        $sqlResult = $linkConnection->query($sqlQuery);
        /* RETORNA JSON */             
        header("Content-Type: application/json");
        echo json_encode($sqlResult);                


    }

    function BorrarNota(){
        # Comprueba que existe el id
        if(ISSET($_REQUEST['idNivel'])){
            $id = $_REQUEST['idNivel'];
            # CODIGO SQL
            $sqlQuery = " DELETE FROM NIVEL WHERE ID= $id";                 
            # CADENA DE CONEXIÓN   
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");                        
            $sqlResult = $linkConnection->query($sqlQuery);
            /* RETORNA JSON */             
            header("Content-Type: application/json");
            echo json_encode($sqlResult);                            

        }else{
            # No se especifico el idNivel
            $rtn = array("id", "3", "error", "idNivel no especificado");
            http_response_code(500);
            print json_encode($rtn);            
        }
    }


    /**
     * Inserta un nuevo elemento 
     */
    function InsertarElemento(){
        # validación de existencia Id
        if(ISSET($_REQUEST['idNivel'])){
            $id = $_REQUEST['idNivel'];
        }else{
            # No se especifico el id
            $rtn = array("id", "3", "error", "idNivel no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }        
        # validación de existencia Nivel
        if(ISSET($_REQUEST['nivel'])){
            $nivel = $_REQUEST['nivel'];
        }else{
            # No se especifico el nivel
            $rtn = array("id", "3", "error", "nivel no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                
        # validación de existencia aula
        if(ISSET($_REQUEST['aula'])){
            $aula = $_REQUEST['aula'];
        }else{
            # No se especifico el aula
            $rtn = array("id", "3", "error", "aula no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                        
        # validación de existencia curso
        if(ISSET($_REQUEST['curso'])){
            $curso = $_REQUEST['curso'];
        }else{
            # No se especifico el curso
            $rtn = array("id", "3", "error", "curso no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                        
        # CADENA DE CONEXIÓN        
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
        # CODIGO SQL
        $sqlQuery = " insert into nivel ( id, nivel, curso, aula ) ";    
        $sqlQuery .= " values( $id, ' $nivel ', '$curso', '$aula' ) ";
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
        $sqlQuery = " SELECT id, nivel, curso, aula from nivel ";                 
        $sqlResult= $linkConnection->query($sqlQuery);
        # Procesado de datos
        $arrayResult = array();
        while($file = $sqlResult->fetch_assoc()){
            $arrayTemp = array();
            $arrayTemp['id'] = $file['id'];
            $arrayTemp['nivel'] = $file['nivel'];            
            $arrayTemp['curso'] = $file['curso'];            
            $arrayTemp['aula'] = $file['aula'];            
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
        #Comprueba que se haya enviado el idNivel
        if(ISSET($_REQUEST['idNivel'])){
            $id = $_REQUEST['idNivel'];
            # CADENA DE CONEXIÓN
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
            # CODIGO SQL
            $sqlQuery = " SELECT id, nivel, curso, aula from nivel where id= $id";                 
            $sqlResult = $linkConnection->query($sqlQuery);
            # Procesado de datos
            $arrayResult = array();
            while($file = $sqlResult->fetch_assoc()){
                $arrayTemp = array();
                $arrayTemp['id'] = $file['id'];
                $arrayTemp['nivel'] = $file['nivel'];            
                $arrayTemp['curso'] = $file['curso'];            
                $arrayTemp['aula'] = $file['aula'];            
                $arrayResult[] =$arrayTemp;
            }     
            /* RETORNA JSON */             
            header("Content-Type: application/json");
            echo json_encode($arrayResult);                

        }else{
            # No se especifico el id
            $rtn = array("id", "3", "error", "idNivel no especificado");
            http_response_code(500);
            print json_encode($rtn);
        }
    }
    
?>