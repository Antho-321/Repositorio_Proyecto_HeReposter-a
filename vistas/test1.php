<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
  <title>Document</title>
</head>

<body>
  <h1>PRUEBA</h1>
  <button id="desc_fact" onclick="DescargarComprobante()"><a>Descargar comprobante de venta</a></button>
  <div>
    <div>
      <a href="#">VARIADO</a>
      <input type="checkbox" name="" id="check">
    </div>
  </div>
  <div><label for="check" class="mostrar_menu">
      &#8801
    </label></div>
</body>
<script>
  function DescargarComprobante() {
    // Create a new jsPDF object
    var doc = new jsPDF();
    // Add some text to the pdf document
    doc.text("Hello, world!", 10, 10);
    // Create a new Image object
    var img = new Image();
    // Set the crossOrigin attribute to allow loading images from other domains
    img.crossOrigin = "Anonymous";
    // Define the onload event handler
    img.onload = function () {
      // Add the image to the pdf document
      doc.addImage(this, "png", 15, 40, 180, 160);
      // Define the headers for the table
      var headers = ["Header 1", "Header 2", "Header 3", "Header 4"];
      // Define the data for the table
      var data = [
        ["Row 1, Column 1", "Row 1, Column 2", "Row 1, Column 3", "Row 1, Column 4"],
        ["Row 2, Column 1", "Row 2, Column 2", "Row 2, Column 3", "Row 2, Column 4"],
        ["Row 3, Column 1", "Row 3, Column 2", "Row 3, Column 3", "Row 3, Column 4"]
      ];
      // Add the table to the pdf document
      var table = doc.autoTable({
        head: [headers],
        body: data,
        startY: doc.internal.pageSize.height // This ensures the table is not drawn over the image
      });
      // Get the y position for the end of the table
      var finalY = table.finalY;
      // Save the PDF file
      doc.save("example.pdf");
    };
    // Set the source of the image
    img.src =
      "https://dipruu.stripocdn.email/content/guids/CABINET_72533ce9143499f857c068a4234fc687515b70207d6550b554554b0a5086e5df/images/pastedimagek6uo200w.png";
  }
</script>

</html>