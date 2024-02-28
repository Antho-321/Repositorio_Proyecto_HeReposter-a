export let estilo_Ingreso_Registro = document.createElement("style");
export let divVentana = document.createElement("div");
export let salto = document.getElementById("Salto");
divVentana.id = "VentanaForm";
estilo_Ingreso_Registro.innerHTML = `
  #Contenido_Cabecera, #contenido_principal, footer{
    opacity: 0.5;
  }
  #Salto{
    background: #0000007a;
    font-family:Sanseriffic;
    letter-spacing: 1.4px;
    transition: initial;
  }
#VentanaForm{
    width: 98.3vw;
    display: flex;
    justify-content: center;
    height: 75vh;
    align-items: center;
}
#VentanaForm *{
    color: black;
}
#Ventana, .Ventana{
    background-color: aliceblue !important;  
    width: 550px;
    height: 75vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    border-radius: 40px;
    z-index: 1;
}
.Mensaje{
    height: auto !important;
}
.Recuperación{
    height: 58vh !important;
}
#Ventana>*, .Ventana>*{
    background-color: transparent !important; 
}
label{
    padding: 0px 10px;
}
#SinCuenta{
    display: flex;
    align-items: center;
}
#ingresar, #sin_cuenta{
    padding: 10px;
}
.btnHaciaDerecha{
    display: flex;
    width: 100%;
    justify-content: flex-end;
}
#Ventana>input, .Ventana>input, #SinCuenta>input, .btnHaciaDerecha>input, #Ventana>button, .Ventana>button {
    border: 1px solid;
    border-color: black;   
    width: auto;
}
#contraseña_olvidada{
    border-color: transparent;
    text-decoration: underline;
}
.entrada_texto{
    width: 20vw !important;
    cursor: auto !important;
}
#btn_salir{
    border-color: transparent;
    font-size: 30px;
    padding: 0px;
}
h3{
    visibility: hidden;
}
.Mensaje p{
    margin: 0px;
    padding: 22px 0px;
}
.Mensaje h2{
    margin: 0px;
    padding: 10px 0px;
}
.Recuperación h2{
    margin: 0px;
}
`;
estilo_Ingreso_Registro.id="est_ingreso_registro";
export function MostrarMensaje(mensaje) {
    document.head.appendChild(estilo_Ingreso_Registro);
    salto.innerHTML = "";
    divVentana.innerHTML = `
    <form class="Mensaje" id="Ventana">
        <div class="btnHaciaDerecha">
            <input type="button" value="✕" id="btn_salir">
        </div>  
        <h2>Estimado usuario</h2>
        <p>`+ mensaje + `</p>
    </form>
    `;
    salto.appendChild(divVentana);
    document.getElementById("btn_salir").addEventListener('click',CerrarVentana);
}
export function CerrarVentana() {
    let estilo_aux = document.getElementById("aux_cont_principal");
    salto.innerHTML = "";
    if (estilo_aux != null || estilo_aux != undefined) {
        estilo_aux.remove();
    } else {
        document.getElementById("est_ingreso_registro").remove();
    }
    let opera_bug = document.getElementById("operaUserStyle");
    if (opera_bug != null && opera_bug != undefined) {
        opera_bug.remove();
    }
    document.querySelector(".rd-nav-link").removeAttribute("style");
}