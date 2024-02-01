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
      margin-top: 20px;
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
    <a href="{{ route('vendedor_tbl_cliente') }}">Clientes</a>
    <a href="{{ route('vendedor_tbl_comprobante_venta') }}">Detalles Pedido</a>
    <a href="{{ route('vendedor_tbl_pedidos') }}">Pedido</a>
    <a href="{{ route('vendedor_tbl_productos') }}">Productos</a>
    <a href="{{ route('vendedor_tbl_comprobante_venta') }}">Comprobantes de Venta</a>
  </div>

  <!-- Content -->
  <div class="content">
    <h1 class="text-center p-3">¡Bienvenido VENDEDOR!</h1>
    <h2 class="text-center p-3">TABLA DE DE COMPROBANTES DE VENTA</h2>

    @if (session("correcto"))
    <div class="alert alert-success">{{session("correcto")}}</div>
    @endif

    @if (session("incorrecto"))
    <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalEditarLabel">Ingresar Comprobante de Venta</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <!-- modal para ingresar -->
            <form action="{{ route("vendedor_registrar_comprobante_venta") }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Id Comprobante</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="comprobanteid" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Id Pedido</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="pedidoid" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Lugar</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="lugar" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="exampleInputPassword1" name="fecha" required>
              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="cantidad" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Concepto</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="concepto" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Cedula Vendedor</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="cedulavendedor" required>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Insertar Comprobante de Venta</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="p-5 table-responsive">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Ingresar Detalle Pedido</button>

      <table class="table table-striped table-bordered table-hover">
        <thead class="bg-primary text-white">
          <tr>
            <th scope="col">Id Comprobate</th>
            <th scope="col">Id Pedido</th>
            <th scope="col">Lugar</th>
            <th scope="col">Fecha</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Concepto</th>
            <th scope="col">Cedula de vendedor</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($datos as $item)
          <tr>
            <th>{{$item->comprobante_id}}</th>
            <td>{{$item->pedido_id}}</td>
            <td>{{$item->lugar}}</td>
            <td>{{$item->fecha}}</td>
            <td>{{$item->cantidad}}</td>
            <td>{{$item->concepto}}</td>
            <td>{{$item->cedula_vendedor }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>