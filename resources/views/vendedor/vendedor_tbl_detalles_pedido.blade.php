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
    <h2 class="text-center p-3">TABLA DE DETALLES DE PEDIDOS</h1>

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
            <h1 class="modal-title fs-5" id="modalEditarLabel">Ingresar Pedido</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <!-- modal para ingresar -->
            <form action="{{ route("vendedor_registrar_detalles_pedido") }}" method="POST">
              @csrf
              
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Pedido</label>
                  <input type="number" class="form-control" id="exampleInputPassword1" name="pedido">
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Tamano-formas</label>
                  <input type="number" class="form-control" id="exampleInputPassword1" name="tamano">
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Tipo</label>
                  <input type="number" class="form-control" id="exampleInputPassword1" name="tipo">
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Relleno</label>
                  <input type="number" class="form-control" id="exampleInputPassword1" name="relleno">
              </div>
              
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Cobertura</label>
                  <input type="number" class="form-control" id="exampleInputPassword1" name="cobertura">
              </div>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Sabores</label>
                  <input type="number" class="form-control" id="exampleInputPassword1" name="sabores">
              </div>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Varios</label>
                  <input type="number" class="form-control" id="exampleInputPassword1" name="varios">
              </div>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Cantidad</label>
                  <input type="decimal" class="form-control" id="exampleInputPassword1" name="cantidad">
              </div>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Precio</label>
                  <input type="number class="form-control" id="exampleInputPassword1" name="precio">
              </div>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Foto</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="foto">
              </div>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Especificacion</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="especificacion">
              </div>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Categoria</label>
                  <input type="number" class="form-control" id="exampleInputPassword1" name="categoria">
              </div>
              
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Insertar Detalle Pedido</button>
              </div>
          </form>
          </div>
          
        </div>
      </div>
    </div>

    <div class="p-5 table-responsive">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar" >Ingresar Detalle Pedido</button>

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
                <th></th>
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
                <td>
                  <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{$item->detalle_id}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                  <a href="{{route("vendedor_eliminar_detalles_pedido",$item->detalle_id)}}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                </td>
                
                <!-- Modal  PARA EDITAR-->
                <div class="modal fade" id="modalEditar{{$item->detalle_id}}" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditarLabel">Modificar detalle</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">


                        <form action="{{route("vendedor_editar_detalles_pedido")}}" method="POST">
                          @csrf
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Codigo detalle</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="detalle" value="{{$item->detalle_id}}" readonly>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Pedido</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="pedido" value="{{$item->pedido_id}}" >
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Tamano-formas</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="tamano" value="{{$item->tamanos_formas_id}}">                          
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Tipo</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="tipo" value="{{$item->tipo_id}}">                          
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Relleno</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="relleno" value="{{$item->relleno_id}}">                          
                          </div>
                          
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Cobertura</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="cobertura" value="{{$item->cobertura_id}}">                          
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Sabores</label>
                            <input type="numer" class="form-control" id="exampleInputPassword1" name="sabores" value="{{$item->sabores_id}}">                          
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Varios</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="varios" value="{{$item->id_varios}}">                          
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Cantidad</label>
                            <input type="decimal" class="form-control" id="exampleInputPassword1" name="cantidad" value="{{$item->cantidad}}">                          
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="precio" value="{{$item->precio}}">                          
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Foto</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="foto" value="{{$item->img}}">                          
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Especificacion</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="especificacion" value="{{$item->especificacion_adicional}}">                          
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Categoria</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="categoria" value="{{$item->categoria_id}}">                          
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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