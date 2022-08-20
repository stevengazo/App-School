<?php

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'VIEW':
        ViewPadreHasAlumno();
        break;
    case 'PUT':
        UpdatePadreHasAlumno();
        break;
    case 'GET':
        GetPadreHasAlumno();
        break;
    case 'POST':
        AddPadreHasAlumno();
        break;
    case 'DELETE':
        DeletePadreHasAlumno();
        break;
    default:
        lanzarJson("Metodo Http no implementado",true,500);
        break;
}


function ViewPadreHasAlumno(){
    lanzarJson("Funcion no implentada no implementado",true,500);
}

function DeletePadreHasAlumno(){    
    lanzarJson("Funcion no implentada no implementado",true,500);    
}

function UpdatePadreHasAlumno(){
    lanzarJson("Funcion no implentada no implementado",true,500);    
}

function AddPadreHasAlumno(){
    lanzarJson("Funcion no implentada no implementado",true,500);    
}
function GetPadreHasAlumno(){
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