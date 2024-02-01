<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/7da396f1a6.js" crossorigin="anonymous"></script>
  <title>CRUD AUDITOR</title>

  <style>
    body {
      font-family: 'Arial', sans-serif;
      background: linear-gradient(45deg, #7AA8FF, #FD3D3D);
      height: 100vh;
      margin: 0;
    }

    .sidebar {
      height: 100%;
      width: 200px;
      position: fixed;
      background-color: #343a40;
      padding-top: 20px;
    }

    .sidebar a {
      padding: 10px 15px;
      text-decoration: none;
      font-size: 18px;
      color: #818181;
      display: block;
    }

    .sidebar a:hover {
      color: #f1f1f1;
    }

    .content {
      margin-left: 200px;
      padding: 20px;
    }

    h1,
    h2 {
      color: #343a40;
    }

    .table {
      margin-top: 20px;
    }

    /* Estilos para el contenedor del gráfico */
    .chart-container {
      max-width: 400px;
      margin: auto;
    }

    .btn-logout {
      position: fixed;
      top: 10px;
      right: 10px;
      z-index: 1000;
    }

    .btn-dark {
      background-color: #343a40;
      color: #ffffff;
    }

    .btn-dark:hover {
      background-color: #1d2124;
    }
  </style>
</head>

<body>

  <button class="btn btn-dark btn-logout" onclick="">Cerrar Sesión</button>
  <!-- Sidebar -->
  <div class="sidebar">
    <img src="{{ asset('images/LOGO_PANKEY.png') }}" alt="Logo" class="img-fluid" style="width: 100%; height: auto; margin-bottom: 20px;">
    <a href="{{ route('auditor_tbl_auditoria') }}">Auditoria</a>
    <a href="{{ route('auditor_tbl_clientes') }}">Clientes</a>
    <a href="{{ route('auditor_tbl_comprobante_venta') }}">Comprobante de Ventas</a>
    <a href="{{ route('auditor_tbl_detalles_pedido') }}">Detalles Pedido</a>
    <a href="{{ route('auditor_tbl_pedido') }}">Pedido</a>
  </div>

  <!-- Content -->
  <div class="content">
    <h1 class="text-center p-3">¡Bienvenido AUDITOR!</h1>
    <h2 class="text-center p-3">TABLA DE PEDIDOS</h1>


      <div class="p-5 table-responsive">

        <table class="table table-striped table-bordered table-hover">
          <thead class="bg-primary text-white">
            <tr>
              <th scope="col">Codigo de Pedido</th>
              <th scope="col">Cliente</th>
              <th scope="col">Fecha pedido</th>
              <th scope="col">Fecha entrega</th>
              <th scope="col">Hora de entrega</th>
              <th scope="col">Pedido confirmado</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($datos as $item)
            <tr>

              <th>{{$item->pedido_id}}</th>
              <td>{{$item->cliente_id}}</td>
              <td>{{$item->fecha_pedido}}</td>
              <td>{{$item->fecha_entrega}}</td>
              <td>{{$item->hora_entrega}}</td>
              <td>{{$item->pedido_confirmado}}</td>


            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>