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
            <h2 class="text-center p-3">TABLA DE PASTELES</h1>

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
                                <h1 class="modal-title fs-5" id="modalEditarLabel">Ingresar Pastel</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <!-- modal para ingresar -->
                                <form action="{{ route('AdministradorPastelIngresar') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Id Tamaños Formas</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtTamanosFormasId">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Id Tipo</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtTipoId">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Id Relleno</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtRellenoId">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Id Cobertura</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtCoberturaId">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Id Sabores</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtSaboresId">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Precio</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtPrecio">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Imagen</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtImg">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Id Categoria</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtCategoriaId">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Insertar Pastel</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="p-5 table-responsive">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Ingresar
                        Pastel</button>


                    <table class="table table-striped table-bordered table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Id Pastel</th>
                                <th scope="col">Id Tamaños Formas</th>
                                <th scope="col">Id Tipo</th>
                                <th scope="col">Id Relleno</th>
                                <th scope="col">Id Cobertura</th>
                                <th scope="col">Id Sabores</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Id Categoria</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos as $item)
                            <tr>

                                <th>{{ $item->pastel_id }}</th>
                                <td>{{ $item->tamanos_formas_id }}</td>
                                <td>{{ $item->tipo_id }}</td>
                                <td>{{ $item->relleno_id }}</td>
                                <td>{{ $item->cobertura_id }}</td>
                                <td>{{ $item->sabores_id }}</td>
                                <td>{{ $item->precio }}</td>
                                <td>{{ $item->img }}</td>
                                <td>{{ $item->categoria_id }}</td>
                                <td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->pastel_id }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{ route('AdministradorPastelEliminar', $item->pastel_id) }}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                </td>
                                <!-- Modal  PARA EDITAR-->
                                <div class="modal fade" id="modalEditar{{ $item->pastel_id }}" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalEditarLabel">Modificar Pastel</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('AdministradorPastelActualizar') }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Id Pastel</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtPastelId" value="{{ $item->pastel_id }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Id Tamaños Formas</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtTamanoFormasId" value="{{ $item->cedula }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Id Tipo</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtTipoId" value="{{ $item->nombre_cliente }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Id Relleno</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtRellenoId" value="{{ $item->telefono }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Id Cobertura</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtCoberturaId" value="{{ $item->direccion_domicilio }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Id Sabores</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtSaboresId" value="{{ $item->email }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Precio</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtPrecio" value="{{ $item->clave }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Imagen</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" name="txtImg" value="{{ $item->clave }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Id Categoria</label>
                                                        <input type="number" class="form-control" id="exampleInputPassword1" name="txtCategoriaId" value="{{ $item->clave }}">
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