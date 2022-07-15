<?php
    require_once "./libs/smarty4_1_1/config_smarty.php";
    class control{
        private $Smarty;

        function __construct(){
            $this->Smarty= new config_smarty();
        }

        function index(){
            // Seteo y envio de datos a la interfaz
            $this->Smarty->setAssign("saludo","Inicio del proyecto");
            // llamada a la interfaz
            $this->Smarty->setDisplay("indexControl.php");
        }
    }
?>