function runQuery(){
let num=0;
    //LA CONSULTA SE ENCUENTRA EN EL ARCHIVO runQuery.php
    //PARA ENVIAR UNA VARIABLE SOLO AGREGAMOS A "../php/runQuery.php LA LÍNEA: ?variable="+variable
    fetch("../php/runQuery.php?num=" + num)
    .then(response => response.json())
    .then(data => { //archivo json       
            console.log(data[0].Img);
    });
}