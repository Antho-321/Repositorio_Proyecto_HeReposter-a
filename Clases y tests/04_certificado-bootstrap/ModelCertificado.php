<?php
class ModelCertificado{
    public function registrarDatos($nombre, $curso, $nota1, $nota2){
        if (($nota1+$nota2)/2>=7) {
            //aprueba el curso
            return array("APROBADO", $nombre, $curso);
        }else{
            //no aprueba, solo asiste
            return array("ASISTIDO", $nombre, $curso);
        }
    }
}
?>