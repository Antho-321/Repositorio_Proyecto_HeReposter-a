<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7da396f1a6.js" crossorigin="anonymous"></script>
    <title>CRUD Administrador</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            @include('administrador.topbar')
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                @include('administrador.sidebarAdministrador')
            </div>
            <div class="col-md-9">
            <h1 class="text-center p-3">¡Bienvenido Administrador!</h1>
            <h2 class="text-center p-3">TABLA DE PEDIDOS</h1>

                @if (session('correcto'))
                <div class="alert alert-success">{{ session('correcto') }}</div>
                @endif

                @if (session('incorrecto'))
                <div class="alert alert-danger">{{ session('incorrecto') }}</div>
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
                                <form action="{{ route('AdministradorPedidosIngresar') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Cliente Id</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtClienteId">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Fecha Pedido </label>
                                        <input type="date" class="form-control" id="exampleInputPassword1" name="txtFechaPedido">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Fecha Entrega</label>
                                        <input type="date" class="form-control" id="exampleInputPassword1" name="txtHoraEntrega">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Hora Entrega</label>
                                        <input type="time" class="form-control" id="exampleInputPassword1" name="txtHoraEntrega">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Pedido Confirmado</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtPedidoConfirmado">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Insertar Pedido</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-5 table-responsive">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Ingresar
                        Pedido</button>


                    <table class="table table-striped table-bordered table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Pedido Id</th>
                                <th scope="col">Cliente Id</th>
                                <th scope="col">Fecha Pedido</th>
                                <th scope="col">Fecha Entrega</th>
                                <th scope="col">Hora Entrega</th>
                                <th scope="col">Pedido Confirmado</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos as $item)
                            <tr>

                                <th>{{ $item->pedido_id }}</th>
                                <td>{{ $item->cliente_id }}</td>
                                <td>{{ $item->fecha_pedido }}</td>
                                <td>{{ $item->fecha_entrega }}</td>
                                <td>{{ $item->hora_entrega }}</td>
                                <td>{{ $item->pedido_confirmado }}</td>
                                <td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->pedido_id }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{ route('AdministradorPedidosEliminar', $item->pedido_id) }}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                </td>
                                <!-- Modal  PARA EDITAR-->
                                <div class="modal fade" id="modalEditar{{ $item->pedido_id }}" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalEditarLabel">Modificar Pedido</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('AdministradorPedidosActualizar') }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Pedido Id</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtPedidoId" value="{{ $item->pedido_id }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Cliente Id</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtClienteId" value="{{ $item->cliente_id }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Fecha Pedido</label>
                                                        <input type="date" class="form-control" id="exampleInputPassword1" name="txtFechaPedido" value="{{ $item->fecha_pedido }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Fecha Entrega</label>
                                                        <input type="date" class="form-control" id="exampleInputPassword1" name="txtFechaEntrega" value="{{ $item->fecha_entrega }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Hora Entrega</label>
                                                        <input type="time" class="form-control" id="exampleInputPassword1" name="txtHoraEntrega" value="{{ $item->hora_entrega }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Pedido Confirmado</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtPedidoConfirmado" value="{{ $item->pedido_confirmado }}">
                                                    </div>


                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar
                                                            Cambios</button>
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
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
                </script>
        </div>
    </div>
    </div>
</body>

</html>