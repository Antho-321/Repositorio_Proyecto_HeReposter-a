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
    <h2 class="text-center p-3">TABLA DE PEDIDOS</h1>


    <div class="p-5 table-responsive">

        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-primary text-white">
              <tr>
                <th scope="col">Codigo de Pedido</th>
                <th scope="col">Cliente</th>
                <th scope="col">Fecha pedido</th>
                <th scope="col">Fecha entrega</th>
                <th scope="col">Hora de entrega</th>
                <th scope="col">Pedido confirmado</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($datos as $item)
              <tr>
               
                <th>{{$item->pedido_id}}</th>
                <td>{{$item->cliente_id}}</td>
                <td>{{$item->fecha_pedido}}</td>
                <td>{{$item->fecha_entrega}}</td>
                <td>{{$item->hora_entrega}}</td>
                <td>{{$item->pedido_confirmado}}</td>
                

              </tr>
              @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>