// Importar la biblioteca
const jsdom = require("jsdom");
const { JSDOM } = jsdom;
const window = new JSDOM("<div id='pdf'>HOLAAAAAAAA</div>").window;
const document = window.document;

// Import and destructure the jsPDF class from the jsPDF library
const { jsPDF } = require("jsPDF/dist/jspdf.node.min");

// Obtener el elemento PDF por su ID
const pdfElement = document.getElementById("pdf");

// Create a function to generate the PDF
function generatePdf() {
  // Create a jsPDF object
  const doc = new jsPDF({ unit: "pt" });

  // Use the html method with options
  doc.html(
    pdfElement, // HTML element
    {
      x: 15, // x-coordinate
      y: 15, // y-coordinate
      width: 180, // maximum width
      callback: function (doc) {
        // Download the PDF file
        doc.save("MyPdfFile.pdf");
      },
    }
  );
}

// Call the function
generatePdf();
