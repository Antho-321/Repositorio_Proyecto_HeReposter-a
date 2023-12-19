<?php 
class Reporte {
    private $NRO_DE_INSERCIONES;
    private $NRO_DE_USUARIOS;
    

    /**
     * Get the value of NRO_DE_INSERCIONES
     */ 
    public function getNRO_DE_INSERCIONES()
    {
        $rango=($this->NRO_DE_INSERCIONES)/3;
        $valor1=0;
        $valor2=intval($rango);
        $valor3=intval($rango*2);
        $valor4=intval($rango*3);
        return array($valor1,$valor2,$valor3,$valor4);
    }

    /**
     * Set the value of NRO_DE_INSERCIONES
     *
     * @return  self
     */ 
    public function setNRO_DE_INSERCIONES($NRO_DE_INSERCIONES)
    {
        $this->NRO_DE_INSERCIONES = $NRO_DE_INSERCIONES;

        return $this;
    }


    /**
     * Get the value of NRO_DE_USUARIOS
     */ 
    public function getNRO_DE_USUARIOS()
    {
        return $this->NRO_DE_USUARIOS;
    }

    /**
     * Set the value of NRO_DE_USUARIOS
     *
     * @return  self
     */ 
    public function setNRO_DE_USUARIOS($NRO_DE_USUARIOS)
    {
        $this->NRO_DE_USUARIOS = $NRO_DE_USUARIOS;

        return $this;
    }
}
?>