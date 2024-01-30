<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/7da396f1a6.js" crossorigin="anonymous"></script>
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
  </style>
  <title>CRUD VENDEDOR</title>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <img src="{{ asset('images/LOGO_PANKEY.png') }}" alt="Logo" class="img-fluid" style="width: 100%; height: auto; margin-bottom: 20px;">
    <a href="{{ route('vendedor_tbl_cliente') }}">Clientes</a>
    <a href="{{ route('vendedor_tbl_detalles_pedido') }}">Detalles Pedido</a>
    <a href="{{ route('vendedor_tbl_pedidos') }}">Pedido</a>
  </div>

  <!-- Content -->
  <div class="content">
    <h1 class="text-center p-3">¡Bienvenido VENDEDOR!</h1>
    <h2 class="text-center p-3">TABLA DE DETALLES PEDIDOS</h2>

    @if (session("correcto"))
    <div class="alert alert-success">{{session("correcto")}}</div>
    @endif

    @if (session("incorrecto"))
    <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <script>
      var res = function() {
        var not = confirm("ESTAS SEGURO QUE DESEAS ELIMINAR?")
        return not;
      }
    </script>
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalEditarLabel">Ingresar Pedido</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <!-- modal para ingresar -->
            <form action="{{ route("vendedor_registrar_detalles_pedido") }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Pedido</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="pedido">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Id varios</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="varios">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Pastel id</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="pastel">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Cantidad de Pastel</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="cantidadpastel">
              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Cantidad varios</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="cantidadvarios">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Dedicatoria</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="dedicatoria">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Especificacion adicional</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="especificacion">
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Insertar Detalle Pedido</button>
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
            <th scope="col">Detalle id</th>
            <th scope="col">Pedido</th>
            <th scope="col">Varios id</th>
            <th scope="col">Pastel id</th>
            <th scope="col">Cantidad de pastel</th>
            <th scope="col">Cantidad Varios</th>
            <th scope="col">Dedicatoria</th>
            <th scope="col">Especificacion Adicional</th>

            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($datos as $item)
          <tr>

            <th>{{$item->detalle_id}}</th>
            <td>{{$item->pedido_id}}</td>
            <td>{{$item->id_varios}}</td>
            <td>{{$item->pastel_id }}</td>
            <td>{{$item->cantidad_pastel}}</td>
            <td>{{$item->cantidad_varios}}</td>
            <td>{{$item->dedicatoria}}</td>
            <td>{{$item->especificacion_adicional}}</td>
            <td>
              <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{$item->detalle_id}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
              <a href="{{route("vendedor_eliminar_detalles_pedido",$item->detalle_id)}}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
            </td>

            <!-- Modal  PARA EDITAR-->
            <div class="modal fade" id="modalEditar{{$item->detalle_id}}" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarLabel">Modificar detalle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">


                    <form action="{{route("vendedor_editar_detalles_pedido")}}" method="POST">
                      @csrf
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Codigo detalle</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" name="detalle" value="{{$item->detalle_id}}" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pedido</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" name="pedido" value="{{$item->pedido_id}}">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Id Varios</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" name="varios" value="{{$item->id_varios }}">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pastel Id</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" name="pastel" value="{{$item-> pastel_id }}">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Cantidad de pastel</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" name="cantidadpastel" value="{{$item->cantidad_pastel}}">
                      </div>

                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Cantidad Varios</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" name="cantidadvarios" value="{{$item->cantidad_varios}}">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Dedicatoria</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="dedicatoria" value="{{$item->dedicatoria}}">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Especificacion Adicional</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="especificacion" value="{{$item->especificacion_adicional}}">
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                      </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>


          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>