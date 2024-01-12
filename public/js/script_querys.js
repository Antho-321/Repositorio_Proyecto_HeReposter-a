var contenido, temporalDiv, cedula, nombre, direccion, telefono, htmlString, id_comprobante, array_carrito, filas_productos;
function Logout() {
  window.location = "../php/Logout.php";
  window.alert("Se ha cerrado sesión");
}
function getReferenciaPasteles(num_pasteles){
  if (num_pasteles>1) {
    return "Pasteles ";
  }else{
    return "Pastel ";
  }
}
function getReferenciaCategoria(categoria){
  let aux_categoria=categoria.toLowerCase();
  if (aux_categoria=="bodas"||aux_categoria=="bautizos"){
    return aux_categoria.slice(0, -1)
  }else{
    return aux_categoria;
  }
}
function DescargarComprobante() {
  id_comprobante=document.getElementById("id_comprobante").value;
  cedula=document.getElementById("cedula").value;
  nombre=document.getElementById("nombre").value;
  direccion=document.getElementById("direccion").value;
  telefono=document.getElementById("telefono").value;
  array_carrito=JSON.parse(localStorage.getItem('datos_carrito'));
  filas_productos="";
  for (let i = array_carrito.length-1; i >= 0; i--) {
    filas_productos+=`
    <tr>
      <td>`+ array_carrito[i].CANTIDAD_CLIENTE + `</td>
      <td>`+getReferenciaPasteles(array_carrito[i].CANTIDAD_CLIENTE)+` de `+getReferenciaCategoria(array_carrito[i].CATEGORIA)+` con sabor a `+array_carrito[i].SABOR.toLowerCase()+` y relleno de `+array_carrito[i].RELLENO.toLowerCase()+`</td>
      <td>$`+array_carrito[i].PRECIO+`</td>
      <td>$`+(array_carrito[i].PRECIO*array_carrito[i].CANTIDAD_CLIENTE)+`</td>
    </tr>
  `;
  }
  
  htmlString = `
  <!DOCTYPE html>
<html lang="en">
<head>
  <title>Nota de venta</title>
  <meta property="og:title" content="Nota de venta" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <meta property="twitter:card" content="summary_large_image" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" />
  <link rel="stylesheet" href="https://unpkg.com/@teleporthq/teleport-custom-scripts/dist/style.css" />

  <style>
    .nota-venta-container {
  width: 100%;
  display: flex;
  overflow: auto;
  box-shadow: 5px 5px 10px 0px #d4d4d4;
  min-height: 100vh;
  align-items: center;
  flex-direction: column;
  justify-content: center;
}
.nota-venta-imagenespasteles {
  width: 998px;
  height: 189px;
}
.nota-venta-logopankey {
  width: 149px;
  height: 134px;
}
.nota-venta-notaventa {
  padding: 0px;
  align-self: flex-start;
  margin-top: 30px;
  margin-left: 50px;
  margin-right: 30px;
  margin-bottom: 30px;
}
.nota-venta-container1 {
  width: 673px;
  height: 196px;
  margin: 10px;
  padding: 0px;
  align-self: center;
}
.nota-venta-container2 {
  display: contents;
}
.nota-venta-container3 {
  width: 593px;
  height: 134px;
  margin: 10px;
  padding: 0px;
  margin-bottom: 10px;
}
.nota-venta-container4 {
  display: contents;
}
.nota-venta-container5 {
  flex: 0 0 auto;
  width: auto;
  height: auto;
  display: flex;
  align-self: flex-start;
  margin-top: 10px;
  align-items: flex-start;
  margin-left: 50px;
  margin-right: 10px;
  margin-bottom: 10px;
  justify-content: center;
}
.nota-venta-telefonoimagen {
  margin: 0px;
  align-self: flex-start;
}
.nota-venta-telefono {
  margin: 10px;
  align-self: center;
  text-align: left;
}
.nota-venta-container6 {
  flex: 0 0 auto;
  width: auto;
  height: auto;
  display: flex;
  align-self: flex-start;
  margin-top: 10px;
  align-items: flex-start;
  margin-left: 50px;
  margin-right: 10px;
  margin-bottom: 10px;
  justify-content: center;
}
.nota-venta-ubicacionimagen {
  align-self: center;
}
.nota-venta-ubicacion {
  margin: 10px;
  align-self: center;
}
.nota-venta-imagenespasteles2 {
  width: 965px;
  height: 223px;
  align-self: center;
}
:root {
  --dl-color-gray-500: #595959;
  --dl-color-gray-700: #999999;
  --dl-color-gray-900: #D9D9D9;
  --dl-size-size-large: 144px;
  --dl-size-size-small: 48px;
  --dl-color-danger-300: #A22020;
  --dl-color-danger-500: #BF2626;
  --dl-color-danger-700: #E14747;
  --dl-color-gray-black: #000000;
  --dl-color-gray-white: #FFFFFF;
  --dl-size-size-medium: 96px;
  --dl-size-size-xlarge: 192px;
  --dl-size-size-xsmall: 16px;
  --dl-space-space-unit: 16px;
  --dl-color-primary-100: #003EB3;
  --dl-color-primary-300: #0074F0;
  --dl-color-primary-500: #14A9FF;
  --dl-color-primary-700: #85DCFF;
  --dl-color-success-300: #199033;
  --dl-color-success-500: #32A94C;
  --dl-color-success-700: #4CC366;
  --dl-size-size-xxlarge: 288px;
  --dl-size-size-maxwidth: 1400px;
  --dl-radius-radius-round: 50%;
  --dl-space-space-halfunit: 8px;
  --dl-space-space-sixunits: 96px;
  --dl-space-space-twounits: 32px;
  --dl-radius-radius-radius2: 2px;
  --dl-radius-radius-radius4: 4px;
  --dl-radius-radius-radius8: 8px;
  --dl-space-space-fiveunits: 80px;
  --dl-space-space-fourunits: 64px;
  --dl-space-space-threeunits: 48px;
  --dl-space-space-oneandhalfunits: 24px;
}
.button {
  color: var(--dl-color-gray-black);
  display: inline-block;
  padding: 0.5rem 1rem;
  border-color: var(--dl-color-gray-black);
  border-width: 1px;
  border-radius: 4px;
  background-color: var(--dl-color-gray-white);
}
.input {
  color: var(--dl-color-gray-black);
  cursor: auto;
  padding: 0.5rem 1rem;
  border-color: var(--dl-color-gray-black);
  border-width: 1px;
  border-radius: 4px;
  background-color: var(--dl-color-gray-white);
}
.textarea {
  color: var(--dl-color-gray-black);
  cursor: auto;
  padding: 0.5rem;
  border-color: var(--dl-color-gray-black);
  border-width: 1px;
  border-radius: 4px;
  background-color: var(--dl-color-gray-white);
}
.list {
  width: 100%;
  margin: 1em 0px 1em 0px;
  display: block;
  padding: 0px 0px 0px 1.5rem;
  list-style-type: none;
  list-style-position: outside;
}
.list-item {
  display: list-item;
}
.teleport-show {
  display: flex !important;
  transform: none !important;
}

.heading {
  font-size: 32px;
  font-family: Inter;
  font-weight: 700;
  line-height: 1.15;
  text-transform: none;
  text-decoration: none;
}
.Content {
  font-size: 16px;
  font-family: Inter;
  font-weight: 400;
  line-height: 1.15;
  text-transform: none;
  text-decoration: none;
}

    /* Consolidate common styles */
    body {
      font-family: Inter;
      font-size: 16px;
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      text-transform: none;
      letter-spacing: normal;
      line-height: 1.15;
      color: var(--dl-color-gray-black);
      background-color: var(--dl-color-gray-white);
      margin: 0;
    }

    /* Add your additional styles here */
    /* ... */

    /* Style for tables */
    table {
      border-collapse: collapse;
      width: 96%;
      margin: 2% 0;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 10px;
      text-align: center;
    }
    .nota-venta-container3{
      display: table;
    }
  </style>
</head>
<body>
  <div class="nota-venta-container">
    <img alt="pastedImage" src="https://dipruu.stripocdn.email/content/guids/CABINET_72533ce9143499f857c068a4234fc687515b70207d6550b554554b0a5086e5df/images/pastedimage0bs81000w.png" class="nota-venta-imagenespasteles" />
    <img alt="pastedImage" src="https://dipruu.stripocdn.email/content/guids/CABINET_72533ce9143499f857c068a4234fc687515b70207d6550b554554b0a5086e5df/images/pastedimagek6uo200w.png" class="nota-venta-logopankey" />
    <span class="nota-venta-notaventa"><b>Nota de venta Nro. `+id_comprobante+`</b>&nbsp;</span>
    <div class="nota-venta-container1">
      <div class="nota-venta-container2">
        <table>
          <tbody>
            <tr>
              <th>Cédula / RUC:</th>
              <td id="cedula_ruc">`+cedula+`</td>
            </tr>
            <tr>
              <th>Nombre:</th>
              <td id="nombre">`+nombre+`</td>
            </tr>
            <tr>
              <th>Dirección domiciliaria:</th>
              <td id="direccion">`+direccion+`</td>
            </tr>
            <tr>
              <th>Teléfono:</th>
              <td id="telefono">`+telefono+`</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="nota-venta-container3">
      <div class="nota-venta-container4">
        <table id="tablaReposteria">
          <tbody>
            <tr>
              <th>Nro. de pasteles</th>
              <th>Descripción</th>
              <th>Precio unitario</th>
              <th>Subtotal</th>
            </tr>
            `+filas_productos+`
            <tr>
              <td colspan="3">Total</td>
              <td>`+document.getElementById("total").innerHTML+`</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="nota-venta-container5">
      <img alt="pastedImage" src="https://dipruu.stripocdn.email/content/guids/CABINET_72533ce9143499f857c068a4234fc687515b70207d6550b554554b0a5086e5df/images/pastedimage6o8p200w.png" class="nota-venta-telefonoimagen" />
      <span class="nota-venta-telefono">0988363503</span>
    </div>
    <div class="nota-venta-container6">
      <img alt="pastedImage" src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/51ab2dfa-ad66-40b7-9a2f-7c317bbee402/8bea7676-137f-4897-ac0c-2768c36f4792?org_if_sml=11397&amp;force_format=original" class="nota-venta-ubicacionimagen" />
      <span class="nota-venta-ubicacion">
        Antonio José de Sucre y Río Blanco, a unos pasos de las bodegas de Bimbo
      </span>
    </div>
    <img alt="pastedImage" src="https://dipruu.stripocdn.email/content/guids/CABINET_72533ce9143499f857c068a4234fc687515b70207d6550b554554b0a5086e5df/images/pastedimage0bs81000w.png" class="nota-venta-imagenespasteles2" />
  </div>
</body>
</html>

  `;

  document.documentElement.innerHTML = "";
  temporalDiv = document.createElement('div');
  temporalDiv.innerHTML = htmlString;
  temporalDiv.style.visibility = 'hidden'; // Ocultar el contenido temporal
  temporalDiv.id = "temporalDiv";
  document.body.appendChild(temporalDiv);

  // Ajustar el tamaño de html2canvas según sea necesario
  html2canvas(temporalDiv, {
    scale: 1, // Puedes ajustar la escala aquí
    useCORS: true, // Intentar cargar imágenes con CORS
    onclone: function (clonedDoc) {
      clonedDoc.getElementById('temporalDiv').style.visibility = '';
    }
  }).then(canvas => {
    var imgData = canvas.toDataURL('image/png');
    var doc = new jsPDF('p', 'mm', 'a4');
    var pageWidth = doc.internal.pageSize.getWidth();
    var pageHeight = doc.internal.pageSize.getHeight();
    var canvasWidth = canvas.width;
    var canvasHeight = canvas.height;

    // Ajustar la relación de aspecto
    var scale = Math.min(pageWidth / canvasWidth, pageHeight / canvasHeight);

    // Agregar la imagen al PDF
    doc.addImage(imgData, 'PNG', 0, 0, canvasWidth * scale, canvasHeight * scale);
    doc.save('nota-venta.pdf');
    document.body.removeChild(temporalDiv); // Eliminar el elemento temporal
    location.reload();
  });
  
  console.log(array_carrito);
}
