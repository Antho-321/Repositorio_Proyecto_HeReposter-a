<?php 
class Auditor {
    private $ID_AUDITORIA;
    private $CEDULA_USUARIO;
    private $FECHA;
    private $HORA;
    private $TABLA_AFECTADA;
    private $OPERACION_REALIZADA;
    private $NOMBRE_USUARIO;
    

    /**
     * Get the value of ID_AUDITORIA
     */ 
    public function getID_AUDITORIA()
    {
        return $this->ID_AUDITORIA;
    }

    /**
     * Set the value of ID_AUDITORIA
     *
     * @return  self
     */ 
    public function setID_AUDITORIA($ID_AUDITORIA)
    {
        $this->ID_AUDITORIA = $ID_AUDITORIA;

        return $this;
    }

    /**
     * Get the value of CEDULA_USUARIO
     */ 
    public function getCEDULA_USUARIO()
    {
        return $this->CEDULA_USUARIO;
    }

    /**
     * Set the value of CEDULA_USUARIO
     *
     * @return  self
     */ 
    public function setCEDULA_USUARIO($CEDULA_USUARIO)
    {
        $this->CEDULA_USUARIO = $CEDULA_USUARIO;

        return $this;
    }

    /**
     * Get the value of FECHA
     */ 
    public function getFECHA()
    {
        return $this->FECHA;
    }

    /**
     * Set the value of FECHA
     *
     * @return  self
     */ 
    public function setFECHA($FECHA)
    {
        $this->FECHA = $FECHA;

        return $this;
    }

    /**
     * Get the value of HORA
     */ 
    public function getHORA()
    {
        return $this->HORA;
    }

    /**
     * Set the value of HORA
     *
     * @return  self
     */ 
    public function setHORA($HORA)
    {
        $this->HORA = $HORA;

        return $this;
    }

    /**
     * Get the value of TABLA_AFECTADA
     */ 
    public function getTABLA_AFECTADA()
    {
        return $this->TABLA_AFECTADA;
    }

    /**
     * Set the value of TABLA_AFECTADA
     *
     * @return  self
     */ 
    public function setTABLA_AFECTADA($TABLA_AFECTADA)
    {
        $this->TABLA_AFECTADA = $TABLA_AFECTADA;

        return $this;
    }

    /**
     * Get the value of OPERACION_REALIZADA
     */ 
    public function getOPERACION_REALIZADA()
    {
        return $this->OPERACION_REALIZADA;
    }

    /**
     * Set the value of OPERACION_REALIZADA
     *
     * @return  self
     */ 
    public function setOPERACION_REALIZADA($OPERACION_REALIZADA)
    {
        $this->OPERACION_REALIZADA = $OPERACION_REALIZADA;

        return $this;
    }

    /**
     * Get the value of NOMBRE_USUARIO
     */ 
    public function getNOMBRE_USUARIO()
    {
        return $this->NOMBRE_USUARIO;
    }

    /**
     * Set the value of NOMBRE_USUARIO
     *
     * @return  self
     */ 
    public function setNOMBRE_USUARIO($NOMBRE_USUARIO)
    {
        $this->NOMBRE_USUARIO = $NOMBRE_USUARIO;

        return $this;
    }
}
?>