<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7da396f1a6.js" crossorigin="anonymous"></script>
    <title>CRUD VENDEDOR</title>
</head>
<body>
    <h1 class="text-center p-3">¡Bienvenido VENDEDOR!</h1>
    <h2 class="text-center p-3">TABLA DE PEDIDOS</h1>

    @if (session("correcto"))
      <div class="alert alert-success">{{session("correcto")}}</div>
    @endif

    @if (session("incorrecto"))
      <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif
    <script>
      var res=function(){
        var not=confirm("ESTAS SEGURO QUE DESEAS ELIMINAR?")
        return not;
      }
    </script>

    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalEditarLabel">Ingresar pedido</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <!-- modal para ingresar -->
            <form action="{{route("vendedor_registrar_pedidos")}}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Id de Pedido</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="idPedido">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Id de cliente</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="idCliente">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Fecha del pedido</label>
                <input type="date" class="form-control" id="exampleInputPassword1" name="fechaPedido">                          
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Fecha de entrega</label>
                <input type="date" class="form-control" id="exampleInputPassword1" name="fechaEntrega">                          
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Hora de entrega</label>
                <input type="time" class="form-control" id="exampleInputPassword1" name="horaEntrega">                          
              </div>
              
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pedido confirmado</label>
                <input type="checkbox" class="form-check-input" id="exampleInputPassword1" name="pedidoConfirmado" value="1">
            </div>
            
              
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Insertar pedido</button>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>

    <div class="p-5 table-responsive">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar" >Ingresar pedidos</button>


      


        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-primary text-white">
              <tr>
                <th scope="col">Codigo de Pedido</th>
                <th scope="col">Cliente</th>
                <th scope="col">Fecha pedido</th>
                <th scope="col">Fecha entrega</th>
                <th scope="col">Hora de entrega</th>
                <th scope="col">Pedido confirmado</th>
                <th></th>
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
                <td>
                  <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{$item->pedido_id}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                  <a href="{{route("vendedor_eliminar_pedidos",$item->pedido_id)}}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                </td>
                
                <!-- Modal  PARA EDITAR-->
                <div class="modal fade" id="modalEditar{{$item->pedido_id}}" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditarLabel">Modificar pedidos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">


                        <form action="{{route("vendedor_editar_pedidos")}}" method="POST">
                          @csrf
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Id de Pedido</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="idPedido" value="{{$item->pedido_id}}" readonly>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Id de cliente</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="idCliente" value="{{$item->cliente_id}}">
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Fecha del pedido</label>
                            <input type="date" class="form-control" id="exampleInputPassword1" name="fechaPedido" value="{{$item->fecha_pedido }}">                          
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Fecha de entrega</label>
                            <input type="date" class="form-control" id="exampleInputPassword1" name="fechaEntrega" value="{{$item->fecha_entrega}}">                          
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Hora de entrega</label>
                            <input type="time" class="form-control" id="exampleInputPassword1" name="horaEntrega" value="{{$item->hora_entrega}}">                          
                          </div>
                          
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pedido confirmado</label>
                            <input type="checkbox" class="form-check-input" id="exampleInputPassword1" name="pedidoConfirmado" value="{{$item->pedido_confirmado}}">
                        </div>
                        
                          
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Editar pedido</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>