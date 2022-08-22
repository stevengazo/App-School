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
function UpdateNota()
{
    if (!isset($_REQUEST['id'])) {
        lanzarJson("id no especificado", true, 500);
        exit;
    } 
    if (!isset($_REQUEST['login'])) {
        lanzarJson("login no especificado", true, 500);
        exit;
    } 
    if (!isset($_REQUEST['password'])) {
        lanzarJson("password no especificado", true, 500);
        exit;
    }     
    if (!isset($_REQUEST['email'])) {
        lanzarJson("email no especificado", true, 500);
        exit;
    }         
    try {
        $id= $_REQUEST['id'];
        $login= $_REQUEST['login'];        
        $password= $_REQUEST['password'];
        $email= $_REQUEST['email'];
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        $sql = '
            UPDATE ADMINISTRADOR
            SET 
                loging ="'.$login.'" ,
                clave = "'.$password.'",
                EMAIL = "'.$email.'"
            WHERE ID ='.$id;        
        $sqlResult = $linkConnection->query($sql);
        lanzarJson($sqlResult,false,200);
        exit;    
    }catch (Exception $e) {
        lanzarJson("Error interno: ".$e->getMessage(), true,500);
        exit;
    } 
}

function BorrarNota()
{
    # CADENA DE CONEXIÓN
    $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
    try {        
        if (!isset($_REQUEST['id'])) {
            lanzarJson("id no especificado", true, 500);
            exit;
        } else{
            $id =$_REQUEST['id'];        
            # CODIGO SQL
            
            $sqlQuery = "DELETE FROM ADMINISTRADOR WHERE id=".$id;            
            $sqlResult = $linkConnection->query($sqlQuery);
            lanzarJson($sqlResult,false,200);
            exit;    
        }
    }catch (Exception $e) {
        lanzarJson("Error interno: ".$e->getMessage(), true,500);
        exit;
    }     

}


/**
 * Inserta un nuevo elemento 
 */
function InsertarElemento()
{
    if (!isset($_REQUEST['id'])) {
        lanzarJson("id no especificado", true, 500);
        exit;
    } 
    if (!isset($_REQUEST['login'])) {
        lanzarJson("login no especificado", true, 500);
        exit;
    } 
    if (!isset($_REQUEST['password'])) {
        lanzarJson("password no especificado", true, 500);
        exit;
    }     
    if (!isset($_REQUEST['email'])) {
        lanzarJson("email no especificado", true, 500);
        exit;
    }         
    try {
        $id= $_REQUEST['id'];
        $login= $_REQUEST['login'];        
        $password= $_REQUEST['password'];
        $email= $_REQUEST['email'];
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        $sql = '
        INSERT INTO ADMINISTRADOR(ID,LOGING,CLAVE,EMAIL)
        VALUES('.$id.',"'.$login.'","'.$password.'","'.$email.'")';    
        $sqlResult = $linkConnection->query($sql);
        lanzarJson($sqlResult,false,200);
        exit;    
    }catch (Exception $e) {
        lanzarJson("Error interno: ".$e->getMessage(), true,500);
        exit;
    } 
}

/**
 * Descripción: lista todos los elementos existentes
 */
function ListarElementos()
{
    # CADENA DE CONEXIÓN
    $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
    $sqlQuery = '
        select 
                id, 
                loging, 
                email 
            from administrador   
        ';
    $sqlResult = $linkConnection->query($sqlQuery);
    $arrayObjectos = array();
    while ($fila = $sqlResult->fetch_assoc()) {
        $ObjectoTemporal = new stdClass();
        $ObjectoTemporal->id = $fila['id'];
        $ObjectoTemporal->login = $fila['loging'];
        $ObjectoTemporal->email = $fila['email'];
        array_push($arrayObjectos, $ObjectoTemporal);
    }
    lanzarJson($arrayObjectos, false, 200);
    exit;
}

/**
 * Retorna un elemento especifico por el id
 */
function GetElement()
{
    if (!isset($_REQUEST['id'])) {
        lanzarJson("id no especificado", true, 500);
        exit;
    } else {
        $id= $_REQUEST['id'];
        # CADENA DE CONEXIÓN
        $linkConnection =  mysqli_connect("localhost", "root", "", "testingdb");
        $sqlQuery = '
            select 
                    id, 
                    loging, 
                    email 
                from administrador   
                where id = 
            '.$id;
        $sqlResult = $linkConnection->query($sqlQuery);
        $ObjectoTemporal = new stdClass();
        while ($fila = $sqlResult->fetch_assoc()) {

            $ObjectoTemporal->id = $fila['id'];
            $ObjectoTemporal->login = $fila['loging'];
            $ObjectoTemporal->email = $fila['email'];
        }
        lanzarJson($ObjectoTemporal, false, 200);
        exit;
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
