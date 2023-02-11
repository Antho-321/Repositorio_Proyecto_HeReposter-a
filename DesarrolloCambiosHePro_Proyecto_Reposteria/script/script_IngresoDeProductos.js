function subirArchivo(){
    let btnsubirArchivo=document.getElementById("ingresoArchivo");
    let divNombreArchivo=document.getElementById("btnsubirArchivo");
   btnsubirArchivo.addEventListener('change', function() {
        // Obtenemos el nombre del archivo seleccionado
        const nombreArchivo = inputFile.files[0].name;
      
        // Mostramos el nombre del archivo en el div
        divNombreArchivo.textContent = `Archivo seleccionado: ${nombreArchivo}`;
      });      
}