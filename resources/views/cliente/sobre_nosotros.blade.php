@extends('plantilla_cliente.plantilla')
@section('estilo')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_SobreNosotros.css') }}" id="estilo">
@endsection
@section('content_envio_correo')
    <input type="hidden" name="pasteles" value="{{ json_encode(Session::get('pasteles')) }}" id="pasteles">
    <form action="{{ route('cliente.ingreso') }}" method="POST" id="Salto">
        @csrf
        <input type="hidden" name="registro" value="false" id="registro">
    </form>
@endsection
@section('content')
    <div id="contenido_principal">
        <div id="DestacadoPrincipal">
            <img src="https://rochinae.files.wordpress.com/2016/02/panadero.jpg?w=776" alt="imagenes">
        </div>
        <div id="texto">
            <h1>Nuestra historia</h1>
            <p>La pastelería "Pankey" fue fundada hace más de 30 años por los hermanos Genny y Carlos, quienes
                aprendieron las técnicas de su padre en la panadería. Genny se quedó con la pastelería cuando los
                hermanos decidieron separarse, y conoció a Luis en un curso de Levapan. Luis compró el horno de Carlos y
                comenzó a trabajar en la pastelería con Genny. Luego de algunos años, se casaron y llevaron la
                pastelería de vuelta a Azaya. Para expandirse y llegar a más clientes, abrieron una sucursal cerca del
                terreno que había heredado Genny, lo que les permitió crear nuevos productos ajustados a las necesidades
                y gustos de la comunidad.</p>
        </div>
    </div>
@endsection
