<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/7da396f1a6.js" crossorigin="anonymous"></script>
  <title>CRUD VENDEDOR</title>

  <style>
    body {
      font-family: 'Arial', sans-serif;
      background: linear-gradient(45deg, #3D89FD, #D25EFA);
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
      margin-top: 0px;
    }

    /* Estilos para los botones de navegación */
    .nav-tabs .nav-item .nav-link {
      background-color: white;
      color: black;
      padding: 10px 15px;
      /* Ajusta según sea necesario */
      margin-right: 5px;
      /* Ajusta según sea necesario para crear espacio entre los botones */
    }

    /* Estilos para el botón activo */
    .nav-tabs .nav-item .nav-link.active {
      background-color: white;
      color: black;
      padding: 10px 15px;
      /* Ajusta según sea necesario */
      margin-right: 5px;
      /* Ajusta según sea necesario para crear espacio entre los botones */
    }
  </style>
</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <img src="{{ asset('images/LOGO_PANKEY.png') }}" alt="Logo" class="img-fluid" style="width: 100%; height: auto; margin-bottom: 20px;">
    <a href="{{ route('vendedor_tbl_cliente') }}">Clientes</a>
    <a href="{{ route('vendedor_tbl_detalles_pedido') }}">Detalles Pedido</a>
    <a href="{{ route('vendedor_tbl_pedidos') }}">Pedido</a>
    <a href="{{ route('vendedor_tbl_productos') }}">Producto</a>
    <a href="{{ route('vendedor_tbl_comprobante_venta') }}">Comprobantes de Venta</a>
  </div>

  <!-- Content -->
  <div class="content">
    <h1 class="text-center p-3">¡Bienvenido VENDEDOR!</h1>
    <h2 class="text-center p-3">PRODUCTOS</h1>
      <ul class="nav nav-tabs" id="myTabs">
        <li class="nav-item">
          <a class="nav-link active" id="pasteles-tab" data-bs-toggle="tab" href="#pasteles">Pasteles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="coberturas-tab" data-bs-toggle="tab" href="#coberturas">Coberturas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="rellenos-tab" data-bs-toggle="tab" href="#rellenos">Rellenos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="sabores-tab" data-bs-toggle="tab" href="#sabores">Sabores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="tipos-tab" data-bs-toggle="tab" href="#tipos">Tipos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="varios-tab" data-bs-toggle="tab" href="#varios">Varios</a>
        </li>
      </ul>
      <div class="tab-content">

        <div class="tab-pane fade show active" id="pasteles">
          <h3 class="text-center p-3">PASTELES</h3>

          <div class="p-5 table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead class="bg-primary text-white">
                <tr>
                  <th scope="col">Id Pastel</th>
                  <th scope="col">Id Formas</th>
                  <th scope="col">Id Tipo</th>
                  <th scope="col">Id Relleno</th>
                  <th scope="col">Id Cobertura</th>
                  <th scope="col">Id Sabores</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Id Categoria</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($datosPastel as $item)
                <tr>
                  <th>{{$item->pastel_id}}</th>
                  <td>{{$item->tamanos_formas_id}}</td>
                  <td>{{$item->tipo_id}}</td>
                  <td>{{$item->relleno_id}}</td>
                  <td>{{$item->cobertura_id }}</td>
                  <td>{{$item->sabores_id }}</td>
                  <td>{{$item->precio}}</td>
                  <!-- Mostrar la imagen usando la etiqueta <img> -->
                  <td><img src="{{ $item->img }}" alt="Imagen del pastel" style="max-width: 100px;"></td>
                  <td>{{$item->categoria_id}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Pestaña de Coberturas -->
        <div class="tab-pane fade" id="coberturas">
          <h3 class="text-center p-3">Coberturas</h3>
          <div class="p-5 table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead class="bg-primary text-white">
                <tr>
                  <th scope="col">Id Cobertura</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Precio Cobertura </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($datosCobertura as $item)
                <tr>
                  <th>{{$item->cobertura_id}}</th>
                  <td>{{$item->cobertura_descripcion}}</td>
                  <td>{{$item->cobertura_precio_base_volumen}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Pestaña de Rellenos -->
        <div class="tab-pane fade" id="rellenos">
          <h3 class="text-center p-3">Rellenos</h3>

          <div class="p-5 table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead class="bg-primary text-white">
                <tr>
                  <th scope="col">Id Relleno</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Altura</th>
                  <th scope="col">Precio Relleno</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($datosRellenos as $item)
                <tr>
                  <th>{{$item->relleno_id}}</th>
                  <td>{{$item->relleno_descripcion}}</td>
                  <td>{{$item->relleno_altura}}</td>
                  <td>{{$item->relleno_precio_base_volumen}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- Pestaña de Sabores -->
        <div class="tab-pane fade" id="sabores">
          <h3 class="text-center p-3">Sabores</h3>

          <div class="p-5 table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead class="bg-primary text-white">
                <tr>
                  <th scope="col">Id Sabor</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Precio Sabor</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($datosSabores as $item)
                <tr>
                  <th>{{$item->sabores_id}}</th>
                  <td>{{$item->sabores_descripcion}}</td>
                  <td>{{$item->sabores_precio_base_volumen}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Pestaña de Tipos -->
        <div class="tab-pane fade" id="tipos">
          <h3 class="text-center p-3">Tipos</h3>
          <div class="p-5 table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead class="bg-primary text-white">
                <tr>
                  <th scope="col">Id Tipos</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Precio Tipos</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($datosTipo as $item)
                <tr>
                  <th>{{$item->tipo_id }}</th>
                  <td>{{$item->tipo_descripcion }}</td>
                  <td>{{$item->tipo_precio_base_volumen}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="varios">
          <h3 class="text-center p-3">Varios</h3>

          <div class="p-5 table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead class="bg-primary text-white">
                <tr>
                  <th scope="col">Id Varios</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Precio Varios</th>
                  <th scope="col">Imagen</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($datosVarios as $item)
                <tr>
                  <th>{{$item->id_varios}}</th>
                  <td>{{$item->descripcion_varios}}</td>
                  <td>{{$item->precio_varios}}</td>
                  <td><img src="{{ $item->img_varios }}" alt="Imagen Varios" style="max-width: 100px;"></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>


  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>