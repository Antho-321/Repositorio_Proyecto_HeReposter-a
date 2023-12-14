function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.currentSrc); // esta línea ha cambiado
    ev.dataTransfer.setDragImage(ev.target, 0, 0);
}

// front_controller.js
function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var img = document.createElement("img");
    img.src = data;
    let myData = myAsyncFunction(data);
    myData.then(result => console.log(result));
    
    //console.log(data);
    ev.target.appendChild(img);
} 

function myAsyncFunction(imagen) {
    let encodedImagen;
    encodedImagen = imagen;
    // if (imagen != undefined) {
    //     if (imagen.includes("http")) {
    //         encodedImagen = encodeURIComponent(imagen);
    //     }
    // }
    return new Promise((resolve, reject) => {
        
        // Usar el método POST y enviar los datos en el cuerpo de la solicitud
        fetch("back_controller.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({imagen: encodedImagen})
        })
            .then(response => response.json())
            .then(data => {
                resolve(data);
            })
            .catch(error => {
                // mostrar el error completo
                console.error(error);
            });
    });
}
