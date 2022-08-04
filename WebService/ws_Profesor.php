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
        if(ISSET($_REQUEST['idProfesor'])){ // COMPRUEBA EXISTENCIA 
            $id = $_REQUEST['idProfesor'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "idProfesor no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['login'])){ // COMPRUEBA EXISTENCIA 
            $login = $_REQUEST['login'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "Algo paso mal...");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }  
        if(isset($_REQUEST['clave'])){
            $clave = $_REQUEST['clave'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "Algo paso mal...");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }              
        if(ISSET($_REQUEST['apellidos'])){ // COMPRUEBA EXISTENCIA 
            $apellidos = $_REQUEST['apellidos'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "apellidos no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                        
        if(ISSET($_REQUEST['email'])){ // COMPRUEBA EXISTENCIA 
            $email = $_REQUEST['email'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "email no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }        
        if(ISSET($_REQUEST['especialista'])){ // COMPRUEBA EXISTENCIA 
            $especialista = $_REQUEST['especialista'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "especialista no especificado");
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
        $sqlQuery = " UPDATE PROFESOR ";       
        $sqlQuery .= " SET login = '$login', clave = md5('$clave'), nombre = '$nombre', apellidos =  '$apellidos', email = '$email' , especialista = $especialista  ";       
        $sqlQuery .= " where id = $id ";
        #EJECUCIÓN CONSULTA
        $sqlResult = $linkConnection->query($sqlQuery);
        /* RETORNA JSON */             
        header("Content-Type: application/json");
        echo json_encode($sqlResult);            
    }

    function BorrarNota(){
        if(ISSET($_REQUEST['idProfesor'])){ // COMPRUEBA EXISTENCIA 
            $id = $_REQUEST['idProfesor'];
            # CADENA DE CONEXIÓN
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
            # CODIGO SQL
            $sqlQuery = " DELETE FROM PROFESOR ";   
            $sqlQuery .= " WHERE ID = $id";
            # EJECUTA EL CODIGO   
            $sqlResult= $linkConnection->query($sqlQuery);
            /* RETORNA JSON */             
            header("Content-Type: application/json");
            echo json_encode($sqlResult);                        
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "idProfesor no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
    }


    /**
     * Inserta un nuevo elemento 
     */
    function InsertarElemento(){
        if(ISSET($_REQUEST['idProfesor'])){ // COMPRUEBA EXISTENCIA 
            $id = $_REQUEST['idProfesor'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "idProfesor no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }
        if(ISSET($_REQUEST['login'])){ // COMPRUEBA EXISTENCIA 
            $login = $_REQUEST['login'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "Algo paso mal...");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }  
        if(isset($_REQUEST['clave'])){
            $clave = $_REQUEST['clave'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "Algo paso mal...");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }              
        if(ISSET($_REQUEST['apellidos'])){ // COMPRUEBA EXISTENCIA 
            $apellidos = $_REQUEST['apellidos'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "apellidos no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                        
        if(ISSET($_REQUEST['email'])){ // COMPRUEBA EXISTENCIA 
            $email = $_REQUEST['email'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "email no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }        
        if(ISSET($_REQUEST['especialista'])){ // COMPRUEBA EXISTENCIA 
            $especialista = $_REQUEST['especialista'];
        }else{
            // id no definido
            $rtn = array("id", "3", "error", "especialista no especificado");
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
        $sqlQuery = " INSERT INTO PROFESOR (ID, LOGIN, CLAVE, NOMBRE, APELLIDOS, EMAIL, ESPECIALISTA) ";       
        $sqlQuery .= " VALUES ( $id , '$clave',md5('$clave'),'$nombre','$apellidos','$email',$especialista) ";       
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
        $sqlQuery = " SELECT * FROM PROFESOR ";   
        # EJECUTA EL CODIGO   
        $sqlResult= $linkConnection->query($sqlQuery);
        #PROCESADO DE RESULTADOS
        $arrayResult = array();
        while($file = $sqlResult->fetch_assoc()){
            $arrayTemp = array();
            $arrayTemp['id'] = $file['id'];
            $arrayTemp['login'] = $file['login'];
            $arrayTemp['nombre'] = $file['nombre'];
            $arrayTemp['apellidos'] = $file['apellidos'];
            $arrayTemp['email'] = $file['email'];
            $arrayTemp['especialista'] = $file['especialista'];
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
        if(ISSET($_REQUEST['idProfesor'])){
            $id = $_REQUEST['idProfesor'];
            # CADENA DE CONEXIÓN
            $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
            # codigo SQL
            $sqlQuery = " SELECT * FROM PROFESOR ";   
            $sqlQuery .= " WHERE id = $id ";
            # EJECUTA EL CODIGO   
            $sqlResult= $linkConnection->query($sqlQuery);
            #PROCESADO DE RESULTADOS
            $arrayResult = null;
            while($file = $sqlResult->fetch_assoc()){
                $arrayTemp = array();
                $arrayTemp['id'] = $file['id'];
                $arrayTemp['login'] = $file['login'];
                $arrayTemp['nombre'] = $file['nombre'];
                $arrayTemp['apellidos'] = $file['apellidos'];
                $arrayTemp['email'] = $file['email'];
                $arrayTemp['especialista'] = $file['especialista'];
                $arrayResult =$arrayTemp;
            }      
            /* RETORNA JSON */             
            header("Content-Type: application/json");
            echo json_encode($arrayResult);   
        }else{
            $rtn = array("id", "3", "error", "IdProfesor no especificado");
            http_response_code(500);
            print json_encode($rtn);
        }
            
    }
