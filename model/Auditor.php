<?php 
class Auditor {
    private $id_auditoria;
    private $cedula_usuario;
    private $fecha;
    private $hora;
    private $tabla_afectada;
    private $operacion_realizada;
    private $nombre_usuario;
    

    /**
     * Get the value of id_auditoria
     */ 
    public function getid_auditoria()
    {
        return $this->id_auditoria;
    }

    /**
     * Set the value of id_auditoria
     *
     * @return  self
     */ 
    public function setid_auditoria($id_auditoria)
    {
        $this->id_auditoria = $id_auditoria;

        return $this;
    }

    /**
     * Get the value of cedula_usuario
     */ 
    public function getcedula_usuario()
    {
        return $this->cedula_usuario;
    }

    /**
     * Set the value of cedula_usuario
     *
     * @return  self
     */ 
    public function setcedula_usuario($cedula_usuario)
    {
        $this->cedula_usuario = $cedula_usuario;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getfecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setfecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of hora
     */ 
    public function gethora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */ 
    public function sethora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get the value of tabla_afectada
     */ 
    public function gettabla_afectada()
    {
        return $this->tabla_afectada;
    }

    /**
     * Set the value of tabla_afectada
     *
     * @return  self
     */ 
    public function settabla_afectada($tabla_afectada)
    {
        $this->tabla_afectada = $tabla_afectada;

        return $this;
    }

    /**
     * Get the value of operacion_realizada
     */ 
    public function getoperacion_realizada()
    {
        return $this->operacion_realizada;
    }

    /**
     * Set the value of operacion_realizada
     *
     * @return  self
     */ 
    public function setoperacion_realizada($operacion_realizada)
    {
        $this->operacion_realizada = $operacion_realizada;

        return $this;
    }

    /**
     * Get the value of nombre_usuario
     */ 
    public function getnombre_usuario()
    {
        return $this->nombre_usuario;
    }

    /**
     * Set the value of nombre_usuario
     *
     * @return  self
     */ 
    public function setnombre_usuario($nombre_usuario)
    {
        $this->nombre_usuario = $nombre_usuario;

        return $this;
    }
}
?>