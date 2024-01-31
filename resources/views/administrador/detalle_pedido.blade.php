<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7da396f1a6.js" crossorigin="anonymous"></script>
    <title>CRUD Administrador</title>
</head>

<body>
    <h1 class="text-center p-3">¡Bienvenido Administrador!</h1>
    <h2 class="text-center p-3">TABLA DE DETALLES PEDIDO</h1>

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
        <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalEditarLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditarLabel">Ingresar Detalle Pedido</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <!-- modal para ingresar -->
                        <form action="{{ route('AdministradorDetallePedidoIngresar') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Pedido Id</label>
                                <input type="number" class="form-control" id="exampleInputPassword1" name="txtPedidoId">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Varios Id</label>
                                <input type="number" class="form-control" id="exampleInputPassword1" name="txtVariosId">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Pastel Id</label>
                                <input type="number" class="form-control" id="exampleInputPassword1"
                                    name="txtPastelId">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Cantidad Pastel</label>
                                <input type="number" class="form-control" id="exampleInputPassword1"
                                    name="txtCantidadPastel">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Cantidad Varios</label>
                                <input type="number" class="form-control" id="exampleInputPassword1" name="txtCantidadVarios">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Dedicatoria</label>
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    name="txtDedicatoria">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Especificacion Adicional</label>
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    name="txtEspecificacionAdicional">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Insertar Detalle Pedido</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="p-5 table-responsive">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Ingresar
                Detalle Pedido</button>


            <table class="table table-striped table-bordered table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Pedido Id</th>
                        <th scope="col">Varios Id</th>
                        <th scope="col">Pastel Id</th>
                        <th scope="col">Cantidad Pastel</th>
                        <th scope="col">Cantidad Varios</th>
                        <th scope="col">Dedicatoria</th>
                        <th scope="col">Especificacion Adicional</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $item)
                        <tr>

                            <th>{{ $item->detalle_id}}</th>
                            <td>{{ $item->pedido_id}}</td>
                            <td>{{ $item->id_varios}}</td>
                            <td>{{ $item->pastel_id}}</td>
                            <td>{{ $item->cantidad_pastel}}</td>
                            <td>{{ $item->cantidad_varios}}</td>
                            <td>{{ $item->dedicatoria}}</td>
                            <td>{{ $item->especificacion_adicional}}</td>
                            <td>
                                <a href="" data-bs-toggle="modal"
                                    data-bs-target="#modalEditar{{ $item->detalle_id }}"
                                    class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('AdministradorDetallePedidoEliminar', $item->detalle_id) }}"
                                    onclick="return res()" class="btn btn-danger btn-sm"><i
                                        class="fa-solid fa-trash"></i></a>
                            </td>
                            <!-- Modal  PARA EDITAR-->
                            <div class="modal fade" id="modalEditar{{ $item->detalle_id }}" tabindex="-1"
                                aria-labelledby="modalEditarLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalEditarLabel">Modificar Detalle Pedido</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('AdministradorDetallePedidoActualizar') }}"
                                                method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1"
                                                        class="form-label">Codigo</label>
                                                    <input type="number" class="form-control"
                                                        id="exampleInputPassword1" name="txtCodigo"
                                                        value="{{ $item->detalle_id }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1"
                                                        class="form-label">Pedido Id</label>
                                                    <input type="number" class="form-control"
                                                        id="exampleInputPassword1" name="txtCedula"
                                                        value="{{ $item->pedido_id }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1"
                                                        class="form-label">Varios Id</label>
                                                    <input type="number" class="form-control"
                                                        id="exampleInputPassword1" name="txtNombre"
                                                        value="{{ $item->id_varios }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1"
                                                        class="form-label">Pastel Id</label>
                                                    <input type="number" class="form-control"
                                                        id="exampleInputPassword1" name="txtTelefono"
                                                        value="{{ $item->pastel_id }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1"
                                                        class="form-label">Cantidad Pastel</label>
                                                    <input type="number" class="form-control"
                                                        id="exampleInputPassword1" name="txtDireccion"
                                                        value="{{ $item->cantidad_pastel }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Cantidad Varios</label>
                                                    <input type="number" class="form-control"
                                                        id="exampleInputPassword1" name="txtCorreo"
                                                        value="{{ $item->cantidad_varios }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1"
                                                        class="form-label">Dedicatoria</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleInputPassword1" name="txtPassword"
                                                        value="{{ $item->dedicatoria }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1"
                                                        class="form-label">Especificacion Adicional</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleInputPassword1" name="txtPassword"
                                                        value="{{ $item->especificacion_adicional }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>
