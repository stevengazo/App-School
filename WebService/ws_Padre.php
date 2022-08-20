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
    lanzarJson("Funcion no implentada no implementado",true,500);
}

function DeletePadre(){    
    lanzarJson("Funcion no implentada no implementado",true,500);    
}

function UpdatePadre(){
    lanzarJson("Funcion no implentada no implementado",true,500);    
}

function AddPadre(){
    lanzarJson("Funcion no implentada no implementado",true,500);    
}
function GetPadre(){
    lanzarJson("Funcion no implentada no implementado",true,500);
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