<?php

    # RestFull

use LDAP\Result;

    $metodo = $_SERVER['REQUEST_METHOD'];

    switch ($metodo) {
        case 'GET':        
            GenerateToken();
            break;
        case 'POST':
            break;
        case 'VIEW':
            break;
        case 'DELETE':
            break;            
        case 'PUT':
            break;                   
        default:
            /**
             * SI EL METODO ES DIFERENTE, DEVUELVE ESTA RESPUESTA
             */
            $rtn = array("id", "3", "error", "metodo no especificado paso mal...");
            http_response_code(500);
            print json_encode($rtn);
            break;
    }


    function GenerateToken(){
        # COMPROBACIONES DE VALORES
        if(ISSET($_REQUEST['txtUsuario'])){ 
            $Usuario =$_REQUEST['txtUsuario'];
        }else{
            $rtn = array("id", "3", "error", "txtUsuario no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                
        if(ISSET($_REQUEST['txtpass'])){ 
            $password =$_REQUEST['txtpass'];
        }else{
            $rtn = array("id", "3", "error", "txtpass no especificada");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }                        
        if(ISSET($_REQUEST['tipoUsuario'])){ 
            $tipoUsuario =$_REQUEST['tipoUsuario'];
        }else{
            $rtn = array("id", "3", "error", "tipoUsuario no especificado");
            http_response_code(500);
            print json_encode($rtn);
            exit;
        }            
        switch ($tipoUsuario) {
            case 'Alumno':
                $loginValid = val_login($Usuario,$password,$tipoUsuario);
                $isEditable = false;
                break;
            case 'Padre':
                $loginValid = val_login($Usuario,$password,$tipoUsuario);                                
                $isEditable = false;
                break;
            case 'Profesor':
                $loginValid = val_login($Usuario,$password,$tipoUsuario);                
                $isEditable = true;
                break;
            case 'Administrador':
                $loginValid = val_login($Usuario,$password,$tipoUsuario);                                
                $isEditable = true;
                break;                                    
            default:
                # code...
                break;
        }   
        # GENERATE TMP TOKEN
        $Random = random_int( 0, 50000);
        $UserId = GetidUser($Usuario,$password, $tipoUsuario);
        #CreateToken($random,$userName, $idUser, $editable)
        CreateToken($Random,$Usuario,$UserId,$isEditable);        
        if($loginValid){            
            $Object = new stdClass();
            $Object->idToken = $Random;
            $Object->Userid= $UserId;
            $Object->Usuario= $Usuario;
            $Object->editable = $isEditable;            
            $Object->idUser = $UserId;            
            http_response_code(200);
            print json_encode($Object);        
        }else{
            $rtn = array("id", "3", "error", "Datos incorrectos");
            http_response_code(500);
            print json_encode($rtn);
            exit;            
        }
    }

    /**
     * Crea un registro temporal en la base de datos
     */
    function CreateToken($random,$userName, $idUser, $editable){
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");                            
        $sqlQuery = "DELETE FROM TOKEN WHERE IDUSER = ".$idUser." AND USERNAME= '". $userName ."' ";
        $Result = $linkConnection->query($sqlQuery);
        $sqlQuery= "";
        $sqlQuery = " INSERT INTO TOKEN (ID , USERNAME, IDUSER, CREACIONDATE, isEditable) ";        
        $sqlQuery .= " values(".$random." , '".$userName."', ".$idUser." ,'". date('Y-m-d H:i:s') ."' , ".$editable." ) ";
        $Result = $linkConnection->query($sqlQuery);
        return $random;
    }    
    /**
     *   VALIDA QUE EL USUARIO ESTE INICIADO
     */
    function val_login($usu,$pass, $tipoUsuario){
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");                    
        switch ($tipoUsuario) {
            case 'Administrador':
                $sql  = "SELECT id,loging,clave FROM administrador";
                $sql .= " WHERE  loging='$usu' AND clave= '$pass'";
                break;
            case 'Alumno':
                $sql  = "SELECT id,login,clave FROM alumno";
                $sql .= " WHERE  login='$usu' AND clave= '$pass'";
                break;            
            case 'Profesor':
                $sql  = "SELECT id,login,clave FROM profesor";
                $sql .= " WHERE  login='$usu' AND clave= '$pass'";
                break;    
            case 'Padre':
                $sql  = "SELECT id,loging,clave FROM PADRE";
                $sql .= " WHERE  loging='$usu' AND clave= '$pass'";
                break;                                
            default:
                $sql = "";
                break;                
        }
        $rs = $linkConnection->query($sql); 
        $count = $rs->fetch_column(1);    
        if($count > 0){
            return true;                   
        } else{
            return false;
        }

    }
    
    function GetidUser($usu,$pass, $tipoUsuario){
        $linkConnection =  mysqli_connect("localhost","root","","testingdb");                    
        switch ($tipoUsuario) {
            case 'Administrador':
                $sql  = "SELECT id FROM administrador";
                $sql .= " WHERE  loging='$usu' AND clave= '$pass'";
                $rs = $linkConnection->query($sql); 
                while ($fila = $rs->fetch_assoc()) {
                    return $fila['id'];
                }                
                break;
            case 'Alumno':
                $sql  = "SELECT id FROM alumno";
                $sql .= " WHERE  login='$usu' AND clave= '$pass'";
                $rs = $linkConnection->query($sql);                 
                while ($fila = $rs->fetch_assoc()) {
                    return $fila['id'];
                }                                
                break;            
            case 'Profesor':
                $sql  = "SELECT id FROM profesor";
                $sql .= " WHERE  login='$usu' AND clave= '$pass'";
                $rs = $linkConnection->query($sql);                 
                while ($fila = $rs->fetch_assoc()) {
                    return $fila['id'];
                }                                
                break;    
            case 'Padre':
                $sql  = "SELECT id FROM PADRE";
                $sql .= " WHERE  loging='$usu' AND clave= '$pass'";
                $rs = $linkConnection->query($sql);                 
                while ($fila = $rs->fetch_assoc()) {
                    return $fila['id'];
                }                                
                break;                                
            default:
                return null;
                break;                
        }                
    }
        

    ?>