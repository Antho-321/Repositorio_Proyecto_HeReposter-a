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
    <h2 class="text-center p-3">TABLA DE DETALLES PEDIDO</h1>


    <div class="p-5 table-responsive">

        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-primary text-white">
              <tr>
                <th scope="col">Detalle id</th>
                <th scope="col">Pedido</th>
                <th scope="col">Forma-Tamano</th>
                <th scope="col">Tipo</th>
                <th scope="col">Relleno</th>
                <th scope="col">Cobertura</th>
                <th scope="col">Sabores</th>
                <th scope="col">Varios</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Foto</th>
                <th scope="col">Especificacion</th>
                <th scope="col">Categoria</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($datos as $item)
              <tr>
                <th>{{$item->detalle_id}}</th>
                <td>{{$item->pedido_id}}</td>
                <td>{{$item->tamanos_formas_id}}</td>
                <td>{{$item->tipo_id}}</td>
                <td>{{$item->relleno_id}}</td>
                <td>{{$item->cobertura_id}}</td>
                <td>{{$item->sabores_id}}</td>
                <td>{{$item->id_varios}}</td>
                <td>{{$item->cantidad}}</td>
                <td>{{$item->precio}}</td>
                <td>{{$item->img}}</td>
                <td>{{$item->especificacion_adicional}}</td>
                <td>{{$item->categoria_id}}</td>
                

              </tr>
              @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>