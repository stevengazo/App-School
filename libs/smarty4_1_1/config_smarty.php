<?php 
    require_once "./libs/smarty4.1.1/Smarty.class.php";

    class config_smarty{
        
        private $objSmarty;

        function __construct()
        {            
            $this->objSmarty = new Smarty(); /// instancia de clase Smarty
            $this->setRutas();
        }

        function setRutas(){
            /// defino las rutas de los directorios que se crearon para smarty
            $this->objSmarty->template_dir   = "view/templates";
            $this->objSmarty->compile_dir = "view/templates_c";
            $this->objSmarty->cache_dir= "control/cache";
            $this->objSmarty->config_dir = "control/configs";

        }
        function setAssign($variable, $valor){
            $this->objSmarty->assign($variable, $valor);            
        }
        function setDisplay($archivo){
            $this->objSmarty->display($archivo);
        }
    }
?>