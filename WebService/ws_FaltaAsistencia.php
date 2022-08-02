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
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
        # CODIGO SQL
        $sqlQuery = " ";       
    }

    function BorrarNota(){
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
        # CODIGO SQL
        $sqlQuery = " ";    
    }


    /**
     * Inserta un nuevo elemento 
     */
    function InsertarElemento(){
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
        # CODIGO SQL
        $sqlQuery = " ";    
    }

    /**
     * Descripción: lista todos los elementos existentes
     */
    function ListarElementos(){
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
        # CODIGO SQL
        $sqlQuery = " ";                 
    }

    /**
     * Retorna un elemento especifico por el id
     */
    function GetElement(){
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");            
        # CODIGO SQL
        $sqlQuery = " ";        
    }
    
?>