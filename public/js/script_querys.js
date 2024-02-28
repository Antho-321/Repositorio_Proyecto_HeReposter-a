import { MostrarMensaje, CerrarVentana } from './funciones_reutilizables.js';
let comprobante_enviado=localStorage.getItem("comprobante_enviado");
function Logout() {
  window.location = "../php/Logout.php";
  window.alert("Se ha cerrado sesión");
}

if (comprobante_enviado!=undefined&&comprobante_enviado!=null) {
  console.log(typeof comprobante_enviado);
  if (comprobante_enviado=="true") {
    MostrarMensaje("Su comprobante de venta ha sido enviado a su correo, en caso de no encontrarlo puede solicitarlo poniéndose en contacto con nosotros.");
    localStorage.removeItem("comprobante_enviado");
  }
}

