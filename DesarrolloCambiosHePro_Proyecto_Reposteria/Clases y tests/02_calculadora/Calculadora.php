<?php
    class Calculadora{
        private $n1;
        private $n2;
        private $suma;

        public function iniciar($num1, $num2){
            $this->n1=$num1;
            $this->n2=$num2;
        }
        public function sumar(){
            return $this->n1+$this->n2;
        }
        public function restar(){
            return $this->n1-$this->n2;
        }
    }
?>