let btn = document.getElementById("op_principales");
let str;
let estilo=document.createElement("style");
let estilo_aux;
estilo.innerHTML=`
body *:not(#opciones>*) {
    opacity: 0.8;
}
#opciones, #opciones *{
    opacity: 1 !important;
}
`;
function mostrarOpciones(){
    estilo_aux=document.getElementsByTagName("style")[0];
    str = window.getComputedStyle(btn).getPropertyValue("visibility");
    if(str=="hidden"){
        btn.style.visibility="visible";
        document.head.appendChild(estilo);
    }else{
        btn.style.visibility="hidden";
        estilo_aux.remove();
    }
    
}