<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <title>CRUD Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/23b73483f9.js" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="text-center p-3">CRUD Clientes</h1>
    <!-- Modal de registrar datos-->
            <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Id</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txtid">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Cedula</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txtcedula">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txtnombre">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txttelefono">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txtdireccion">
                    </div><div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txtemail">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Clave</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txtclave">
                    </div>
                     <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                    </form>
                </div>
                </div>
            </div>
            </div> 
   <div class="p-5 table-responsive">
   <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Añadir Cliente</button>
   <table class="table table-striped table-bordered tabel-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Cédula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Dirección</th>
                <th scope="col">Email</th>
                <th scope="col">Clave</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datos as $item)
            <tr>
                <th>{{$item->cliente_id}}</th>
                <td>{{$item->cedula}}</td>
                <td>{{$item->nombre_cliente}}</td>
                <td>{{$item->telefono}}</td>
                <td>{{$item->direccion_domicilio}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->clave}}</td>
                <td>
                    <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar" class="btn btn-danger btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="" class="btn btn-dark btn-sm"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <!-- Modal de modificar datos-->
            <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Id</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txtid">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Cedula</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txtcedula">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txtnombre">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txttelefono">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txtdireccion">
                    </div><div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txtemail">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Clave</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" 
                        aria-describedby="IdCliente" name="txtclave">
                    </div>
                     <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                    </form>
                </div>
                </div>
            </div>
            </div>  
            @endforeach
        </tbody>
    </table>

   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
