<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            <h2 class="text-center p-3">TABLA DE CLIENTES</h1>

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
                                <h1 class="modal-title fs-5" id="modalEditarLabel">Ingresar cliente</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <!-- modal para ingresar -->
                                <form action="{{ route('AdministradorClientesIngresar') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Cedula</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtCedula">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtNombre">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Telefono</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtTelefono">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Direccion</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtDireccion">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Correo</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtCorreo">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="txtPassword">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Insertar Cliente</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="p-5 table-responsive">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Ingresar
                        cliente</button>


                    <table class="table table-striped table-bordered table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Clave</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos as $item)
                            <tr>

                                <th>{{ $item->cliente_id }}</th>
                                <td>{{ $item->cedula }}</td>
                                <td>{{ $item->nombre_cliente }}</td>
                                <td>{{ $item->telefono }}</td>
                                <td>{{ $item->direccion_domicilio }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->clave }}</td>
                                <td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->cliente_id }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{ route('AdministradorClientesEliminar', $item->cliente_id) }}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                </td>
                                <!-- Modal  PARA EDITAR-->
                                <div class="modal fade" id="modalEditar{{ $item->cliente_id }}" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalEditarLabel">Modificar cliente</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('AdministradorClientesActualizar') }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Codigo</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtCodigo" value="{{ $item->cliente_id }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Cedula</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtCedula" value="{{ $item->cedula }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Nombre</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtNombre" value="{{ $item->nombre_cliente }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Telefono</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtTelefono" value="{{ $item->telefono }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Direccion</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtDireccion" value="{{ $item->direccion_domicilio }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Correo</label>
                                                        <input type="email" class="form-control" id="exampleInputPassword1" name="txtCorreo" value="{{ $item->email }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Password</label>
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