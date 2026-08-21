{{-- Cuadro de foto: la imagen entera —sin recortar ni deformar— sobre un fondo
     hecho con esa misma foto ampliada y desenfocada, que rellena las bandas que
     quedan libres. El estilo está en css/estilos_reutilizables.css (.cuadro-foto),
     donde se explica el porqué y qué se puede ajustar.

     La dirección de la foto va dos veces: en el src de la imagen y en la
     variable --foto, que es de donde la lee el fondo. Ese es justamente el
     motivo de que esto sea un parcial y no dos líneas sueltas en cada vista:
     así no hay forma de cambiar una y olvidarse de la otra.

     Parámetros:
       $src           dirección de la foto                        (obligatorio)
       $alt           texto alternativo                           (obligatorio)
       $clase         clases extra para el cuadro                  (opcional)
       $claseImagen   clases extra para la <img>                   (opcional)
       $nombre        atributo name de la <img>                    (opcional)

     Ejemplo:
       @include('componentes.cuadro_foto', [
           'src' => $pastel->img,
           'alt' => 'Pastel de chocolate',
       ])
--}}
<div class="cuadro-foto{{ isset($clase) ? ' ' . $clase : '' }}" style="--foto: url('{{ $src }}')">
    <img src="{{ $src }}" alt="{{ $alt }}"
         @isset($claseImagen) class="{{ $claseImagen }}" @endisset
         @isset($nombre) name="{{ $nombre }}" @endisset>
</div>
