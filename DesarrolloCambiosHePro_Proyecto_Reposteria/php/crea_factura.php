
<?php
session_start();
include("../php/Conexion.php");
$conexion = new Conexion;
$cedula= $_SESSION['cedula'];
$id_usuario= $_SESSION['id'];
$aux= $conexion->OperSql("SELECT `Nombre`, `Apellido` FROM `cliente` WHERE `Cedula` = '$cedula';");
$aux= $aux->fetch_array();
$nombre= $aux['Nombre']." ".$aux['Apellido'];

//Parte en la que va a obtener los dados 

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Factura</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
</div><div id="app" class="col-11">

    <h2>Factura</h2>

    <div class="row my-3">
      <div class="col-10">
        <h1>Pankey</h1>
        <p>Ibarra</p>
        <p>Tobías Mena y Atahualpa</p>
        <p>Sector del coliseo "la bola amarilla"</p>
      </div>
      <div class="col-2">
        <img src="../imagenes/LOGO_PANKEY1.png" width="200px" height="200px" />
      </div>
    </div>
  
    <hr />
  
    <div class="row fact-info mt-3">
      <div class="col-3">
        <h5>Facturar a</h5>
        <p>
          <?php echo $nombre?><br>
          <?php echo $cedula?>
        </p>
      </div>
      <div class="col-3">
        <h5>Enviar a</h5>
        <p>
          Cotui, Sanchez Ramirez
          Santa Fe, #19
          arianmanuel75@gmail.com
        </p>
      </div>
      <div class="col-3">
        <h5>N° de factura</h5>
        <h5>Fecha</h5>
        <h5>Fecha de vencimiento</h5>
      </div>
      <div class="col-3">
        <h5>103</h5>
        <p>09/05/2019</p>
        <p>09/05/2019</p>
      </div>
    </div>
  
    <div class="row my-5">
      <table class="table table-borderless factura">
        <thead>
          <tr>
            <th>Cant.</th>
            <th>Descripcion</th>
            <th>Precio Unitario</th>
            <th>Importe</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Clases de Cha-Cha-Cha</td>
            <td>3,000.00</td>
            <td>3,000.00</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Clases de Salsa</td>
            <td>4,000.00</td>
            <td>12,000.00</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th>Total Factura</th>
            <th>RD$15,000.00</th>
          </tr>
        </tfoot>
      </table>
    </div>
  
    <div class="cond row">
      <div class="col-12 mt-3">
        <h4>Condiciones y formas de pago</h4>
        <p>El pago se debe realizar en un plazo de 15 dias.</p>
        <p>
          Banco Banreserva
          <br />
          IBAN: DO XX 0075 XXXX XX XX XXXX XXXX
          <br />
          Código SWIFT: BPDODOSXXXX
        </p>
      </div>
    </div>
</div>
<!-- partial -->
  
</body>
</html>
