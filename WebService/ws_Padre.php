<?php

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'VIEW':
        ViewPadre();
        break;
    case 'PUT':
        UpdatePadre();
        break;
    case 'GET':
        GetPadre();
        break;
    case 'POST':
        AddPadre();
        break;
    case 'DELETE':
        DeletePadre();
        break;
    default:
        lanzarJson("Metodo Http no implementado",true,500);
        break;
}


function ViewPadre(){
    if(!isset($_REQUEST['id'])){
        lanzarJson("id no definido",true,500);
    }else{        
        $id = $_REQUEST['id'];
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");                            
        $sqlQuery = ' SELECT id,email, loging,nombre, apellidos from Padre where id ='.$id;        
        $sqlResult = $linkConnection->query($sqlQuery);
        $ObjectoTemporal = new stdClass();    
        while($fila = $sqlResult->fetch_assoc()){
            $ObjectoTemporal->idUser = $fila['id'];
            $ObjectoTemporal->login = $fila['loging'];
            $ObjectoTemporal->email = $fila['email'];
            $ObjectoTemporal->nombre = $fila['nombre'];
            $ObjectoTemporal->apellidos = $fila['apellidos'];            
        }
        # Implementar funcion para agregar hijos
        $ObjectoTemporal->Alumnos= getAlumnos();
        lanzarJson($ObjectoTemporal,false,200);
        exit;
    }
}

function GetAlumnos(){
    return array();
}

function DeletePadre(){    
    if(!isset($_REQUEST['id'])){
        lanzarJson("id no definido",true,500);
        exit;
    }
    try {
        $id = $_REQUEST['id'];        
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");                            
        $sqlQuery = '                    
            DELETE FROM PADRE
            WHERE ID ='.$id; 
        $sqlResult = $linkConnection->query($sqlQuery);
        lanzarJson($sqlResult,false,200);
        exit;
    } catch (Exception $e) {
        lanzarJson($e->getMessage(), true,500);
        exit;
    }     

}

function UpdatePadre(){
    if(!isset($_REQUEST['id'])){
        lanzarJson("id no definido",true,500);
        exit;
    }
    if(!isset($_REQUEST['login'])){
        lanzarJson("login no definido",true,500);
        exit;
    }
    if(!isset($_REQUEST['clave'])){
        lanzarJson("clave no definido",true,500);
        exit;
    }
    if(!isset($_REQUEST['email'])){
        lanzarJson("email no definido",true,500);
        exit;
    }        
    if(!isset($_REQUEST['nombre'])){
        lanzarJson("nombre no definido",true,500);
        exit;
    }        
    if(!isset($_REQUEST['apellidos'])){        
        lanzarJson("apellidos no definido",true,500);
        exit;
    }   
    try {
        $id = $_REQUEST['id'];        
        $login = $_REQUEST['login'];        
        $clave = $_REQUEST['clave'];
        $email = $_REQUEST['email'];
        $nombre = $_REQUEST['nombre'];
        $apellidos = $_REQUEST['apellidos'];
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");                            
        $sqlQuery = '
            UPDATE PADRE
            SET 
                loging = "'.$login.'",
                CLAVE = "'.$clave.'",
                EMAIL = "'.$email.'",
                NOMBRE = "'.$nombre.'",
                APELLIDOS = "'.$apellidos.'"
            WHERE ID = '.$id.'
        '; 
        $sqlResult = $linkConnection->query($sqlQuery);
        lanzarJson($sqlResult,false,200);
        exit;
    } catch (Exception $e) {
        lanzarJson("Error interno: ".$e->getMessage(), true,500);
        exit;
    }     
}

function AddPadre(){
    if(!isset($_REQUEST['id'])){
        lanzarJson("id no definido",true,500);
        exit;
    }
    if(!isset($_REQUEST['login'])){
        lanzarJson("login no definido",true,500);
        exit;
    }
    if(!isset($_REQUEST['clave'])){
        lanzarJson("clave no definido",true,500);
        exit;
    }
    if(!isset($_REQUEST['email'])){
        lanzarJson("email no definido",true,500);
        exit;
    }        
    if(!isset($_REQUEST['nombre'])){
        lanzarJson("nombre no definido",true,500);
        exit;
    }        
    if(!isset($_REQUEST['apellidos'])){        
        lanzarJson("apellidos no definido",true,500);
        exit;
    }   
    try {
        $id = $_REQUEST['id'];        
        $login = $_REQUEST['login'];        
        $clave = $_REQUEST['clave'];
        $email = $_REQUEST['email'];
        $nombre = $_REQUEST['nombre'];
        $apellidos = $_REQUEST['apellidos'];
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");                            
        $sqlQuery = '
        INSERT INTO PADRE (ID, LOGING,CLAVE,EMAIL,NOMBRE,APELLIDOS)
                    VALUES('.$id.' ,"'.$login.'","'.$clave.'","'.$email.'","'.$nombre.'","'.$apellidos.'")
        '; 
        $sqlResult = $linkConnection->query($sqlQuery);
        lanzarJson($sqlResult,false,200);
        exit;
    } catch (Exception $e) {
        lanzarJson("Error interno: ".$e->getMessage(), true,500);
        exit;
    }     

}


function GetPadre(){
    if(!isset($_REQUEST['tipo'])){
        lanzarJson("tipo no definido",true,500);
    }else{
        $tipo = $_REQUEST['tipo'];
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");                            
        $sqlQuery = '';        
        switch ($tipo) {
            case 'lista':
                $sqlQuery = ' SELECT id,email, loging,nombre, apellidos from Padre ';
                $sqlResult = $linkConnection->query($sqlQuery);
                $arrayObjectos = array();
                while($fila = $sqlResult->fetch_assoc()){
                    $ObjectoTemporal = new stdClass();
                    $ObjectoTemporal->idUser = $fila['id'];
                    $ObjectoTemporal->login = $fila['loging'];
                    $ObjectoTemporal->email = $fila['email'];
                    $ObjectoTemporal->nombre = $fila['nombre'];
                    $ObjectoTemporal->apellidos = $fila['apellidos'];
                    array_push($arrayObjectos,$ObjectoTemporal);
                }
                lanzarJson($arrayObjectos,false,200);
                exit;
                break;
            case 'elemento':
                # code...
                break;            
            default:
                lanzarJson("tipo no especificado (lista, elemento)", true,404);
                exit;
                break;
        }
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