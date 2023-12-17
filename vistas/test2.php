<!DOCTYPE html>
<html>

<head>
  <title>HTML a PDF</title>
  <link rel="stylesheet" type="text/css" href="../styles/estilo_Modificación_CarritoDeCompras.css" id="estilo">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script>
  
</head>

<body>

  <button onclick="convertirHTMLaPDF()" id="check3">Convertir a PDF</button>
  <input type="checkbox" id="check2">
    <header id="Cabecera">
        <div id="Contenido_Cabecera">
            <img src="../imagenes/LOGO_PANKEY1.png" alt="LOGO_PANKEY" id="LogoPankey">
            <input type="checkbox" id="check">
            <label for="check" class="mostrar_menu">
                &#8801
            </label>
            <div id="botones_iconos">
                <section id="seccion_botones">
                    <a href="index.php">Inicio</a>
                    <a href="SobreNosotros.php">Sobre nosotros</a>
                    <div id="Catalogo">
                        <input class="Btn_Catalogo" type="button" value="Catalogo">
                        <div>
                            <div id="Menu_Catalogo">
                                <input type="button" value="Bodas">
                                <input type="button" value="Bautizos">
                                <input type="button" value="XV años">
                                <input type="button" value="Cumpleaños">
                                <input type="button" value="Baby Shower">
                                <input type="button" value="San Valentin">
                                <input type="button" value="Halloween">
                                <input type="button" value="Navidad">
                            </div>
                        </div>
                    </div>
                    <a href="PastelesPersonalizados.php">Pasteles personalizados</a>
                </section>
                <section id="seccion_iconos">
                    <a href="../vistas/CarritoDeCompras.php">
                        <img src="../iconos/carro-de-la-carretilla.png" type="button" value="Catalogo">
                    </a>
                    <img onclick="mostrarBúsqueda()" src="../iconos/lupa1.png" type="button" value="Catalogo">
                    <div id="seccion_busqueda">
                        <input type="search" id="búsqueda">
                    </div>
                    <?php if (!isset($id)) { ?>
                        <input type="button" value="Ingresar" id="Ingreso" onclick="MostrarVentanaDeIngreso()">
                    <?php } else { ?>
                        <button onclick="Logout()" id="Salida"><a>Salir</button>
                    <?php } ?>

                </section>
                <label for="check" class="esconder_menu">
                    &#215
                </label>
            </div>
        </div>
        <div id="Salto">
        </div>
    </header>
  <script>
    function convertirHTMLaPDF() {
      // Tu HTML en una variable string
      var htmlString = `<!DOCTYPE html>
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
    <span class="nota-venta-notaventa">Nota de venta Nro. X1&nbsp;</span>
    <div class="nota-venta-container1">
      <div class="nota-venta-container2">
        <table>
          <tbody>
            <tr>
              <th>Cédula / RUC:</th>
              <td id="cedula_ruc">X2</td>
            </tr>
            <tr>
              <th>Nombre:</th>
              <td id="nombre">X3</td>
            </tr>
            <tr>
              <th>Dirección domiciliaria:</th>
              <td id="direccion">X4</td>
            </tr>
            <tr>
              <th>Teléfono:</th>
              <td id="telefono">X5</td>
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
            <tr>
              <td>X6</td>
              <td>Pastel/es de (categoría) con sabor a (sabor) y relleno de (relleno)</td>
              <td>$X7</td>
              <td>$X8</td>
            </tr>
            <tr>
              <td>X6</td>
              <td>Pastel/es de (categoría) con sabor a (sabor) y relleno de (relleno)</td>
              <td>$X7</td>
              <td>$X8</td>
            </tr>
            <tr>
              <td colspan="3">Total</td>
              <td>$X9</td>
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
`; // tu string HTML aquí

      // Crear un elemento temporal en el DOM
      var temporalDiv = document.createElement('div');
      temporalDiv.innerHTML = htmlString;
      temporalDiv.style.visibility = 'hidden'; // Ocultar el contenido temporal
      temporalDiv.id = "temporalDiv";
      document.body.appendChild(temporalDiv);

      // Esperar un momento para renderizar
      setTimeout(() => {
        html2canvas(temporalDiv, {
          useCORS: true, // Esto puede ayudar con las imágenes
          onclone: function (clonedDoc) {
            clonedDoc.getElementById('temporalDiv').style.visibility = '';
          }
        }).then(canvas => {
          var imgData = canvas.toDataURL('image/png');
          var doc = new jsPDF('p', 'mm', 'a4'); // Ajusta el tamaño aquí según sea necesario
          var pageWidth = doc.internal.pageSize.width;
          var pageHeight = doc.internal.pageSize.height;
          var imageWidth = canvas.width;
          var imageHeight = canvas.height;
          var ratio = imageWidth / imageHeight >= pageWidth / pageHeight ? pageWidth / imageWidth : pageHeight / imageHeight;

          doc.addImage(imgData, 'PNG', 0, 0, imageWidth * ratio, imageHeight * ratio);
          doc.save('nota-venta.pdf');

          document.body.removeChild(temporalDiv); // Eliminar el elemento temporal
        });
      }, 1500); // Tiempo de espera en milisegundos
    }        
  </script>
<footer>
        <div id="Derechos">
            © 2023 Web Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
</body>

</html>