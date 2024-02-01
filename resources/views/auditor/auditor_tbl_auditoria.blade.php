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
    <h2 class="text-center p-3">TABLA DE AUDITORIA</h2>

    <!-- Gráfico de Pastel -->
    <div class="p-5">
      <h2 class="text-center p-3">Gráfico de Operaciones Realizadas</h2>

      <!-- Contenedor del gráfico con dimensiones controladas -->
      <div class="chart-container">
        <!-- Canvas para el gráfico -->
        <canvas id="operacionesRealizadasChart" width="400" height="400"></canvas>
      </div>
    </div>

    <div class="p-5 table-responsive">
      <table class="table table-striped table-bordered table-hover">
        <thead class="bg-primary text-white">
          <tr>
            <th scope="col">Codigo Auditoria</th>
            <th scope="col">Cedula de usuario</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Tabla Afectada</th>
            <th scope="col">Operacion realizada</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($datos as $item)
          <tr>
            <th>{{$item->id_auditoria }}</th>
            <td>{{$item->cedula_usuario}}</td>
            <td>{{$item->fecha}}</td>
            <td>{{$item->hora}}</td>
            <td>{{$item->tabla_afectada}}</td>
            <td>{{$item->operacion_realizada}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Script para configurar el gráfico -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var operacionesRealizadasData = <?php echo json_encode($operacionesRealizadasData); ?>;

      var ctx = document.getElementById('operacionesRealizadasChart').getContext('2d');
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: Object.keys(operacionesRealizadasData),
          datasets: [{
            data: Object.values(operacionesRealizadasData),
            backgroundColor: [
              'rgba(255, 99, 132, 0.8)',
              'rgba(54, 162, 235, 0.8)',
              'rgba(255, 206, 86, 0.8)',
              'rgba(75, 192, 192, 0.8)',
              'rgba(153, 102, 255, 0.8)',
              'rgba(255, 159, 64, 0.8)'
            ],
          }]
        },
        options: {
          responsive: false, // Desactiva la responsividad
          maintainAspectRatio: true, // Mantén la proporción del aspecto
          title: {
            display: true,
            text: 'Operaciones Realizadas'
          }
        },
        // Ajusta las dimensiones directamente
        width: 300,
        height: 300
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>