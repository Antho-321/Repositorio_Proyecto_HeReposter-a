<?php
    class ModelLogin{
        public function validarCredencial($usuario,$clave){
            if($usuario=="prueba" && $clave=="1234"){
                return true;
            }else{
                return false;
            }
        }
    }
?>