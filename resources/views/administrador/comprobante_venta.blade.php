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
            <h1 class="text-center p-3">¡Bienvenido Administrador!</h1>
            <h2 class="text-center p-3">TABLA DE COMPROBANTE VENTA</h1>

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
                                <h1 class="modal-title fs-5" id="modalEditarLabel">Ingresar Comprobante Venta</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <!-- modal para ingresar -->
                                <form action="{{ route('AdministradorComprobanteVentaIngresar') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Id pedido</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtPedidoId">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Lugar</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtLugar">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Fecha</label>
                                        <input type="date" class="form-control" id="exampleInputPassword1" name="txtFecha">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Cantidad</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtCantidad">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Concepto</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtConcepto">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Cedula Vendedor</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtCedulaV">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Insertar Comprobante Venta</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="p-5 table-responsive">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Ingresar
                        Comprobante Venta</button>


                    <table class="table table-striped table-bordered table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Id Comprobante</th>
                                <th scope="col">Id Pedido</th>
                                <th scope="col">Lugar</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Concepto</th>
                                <th scope="col">Cedula Vendedor</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos as $item)
                            <tr>
                                <th>{{ $item->comprobante_id }}</th>
                                <td>{{ $item->pedido_id }}</td>
                                <td>{{ $item->lugar }}</td>
                                <td>{{ $item->fecha }}</td>
                                <td>{{ $item->cantidad }}</td>
                                <td>{{ $item->concepto }}</td>
                                <td>{{ $item->cedula_vendedor }}</td>
                                <td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->comprobante_id }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{ route('AdministradorComprobanteVentaEliminar', $item->comprobante_id) }}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                </td>
                                <!-- Modal  PARA EDITAR-->
                                <div class="modal fade" id="modalEditar{{ $item->comprobante_id }}" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalEditarLabel">Modificar Comprobante Venta</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('AdministradorComprobanteVentaActualizar') }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Id Comprobante</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtCodigo" value="{{ $item->comprobante_id }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Id Pedido</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtCedula" value="{{ $item->cedula }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Lugar</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtNombre" value="{{ $item->nombre_cliente }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Fecha</label>
                                                        <input type="date" class="form-control" id="exampleInputPassword1" name="txtTelefono" value="{{ $item->telefono }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Cantidad</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtDireccion" value="{{ $item->direccion_domicilio }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Concepto</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtCorreo" value="{{ $item->email }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Cedula vendedor</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtPassword" value="{{ $item->clave }}">
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