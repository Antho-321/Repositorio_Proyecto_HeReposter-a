<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7da396f1a6.js" crossorigin="anonymous"></script>
    <title>CRUD AUDITOR</title>
</head>
<body>
    <h1 class="text-center p-3">¡Bienvenido AUDITOR!</h1>
    <h2 class="text-center p-3">TABLA DE CLIENTES</h1>


    <div class="p-5 table-responsive">

        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-primary text-white">
              <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Cedula</th>
                <th scope="col">Cliente</th>
                <th scope="col">Cliente</th>
                <th scope="col">Direccion</th>
                <th scope="col">Correo</th>
                <th scope="col">Clave</th>
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
                

              </tr>
              @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>