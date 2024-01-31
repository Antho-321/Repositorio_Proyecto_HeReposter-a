paypal.Buttons({
    // Configura la transacción cuando se hace clic en un botón de pago
    createOrder: (data, actions) => {

        return actions.order.create({
            purchase_units: [{
                items: [
                    {
                        name: 'pastel de vísperas de santos',
                        quantity: '4',
                        unit_amount: {
                            currency_code: 'USD',
                            value: '25.00'
                        }
                    },
                    {
                        name: 'pastel de cumpleaños',
                        quantity: '4',
                        unit_amount: {
                            currency_code: 'USD',
                            value: '25.00'
                        }
                    }
                ],
                amount: {
                    currency_code: 'USD',
                    value: '200.00', // También puede hacer referencia a una variable o función.
                    breakdown: {
                        item_total: {
                            currency_code: 'USD',
                            value: '200.00'
                        }
                    }
                }
                           
            }]

        });

    },
    // Finalizar la transacción después de la aprobación del pagador
    onApprove: (data, actions) => {
        return actions.order.capture().then(function (orderData) {
            // ¡Captura exitosa! Para propósitos de desarrollo/demostración:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            // Obtén el elemento antiguo
            let elementoViejo = document.getElementById("paypal-button-container");

            // Crea el nuevo elemento
            let elementoNuevo = document.createElement("img");
            elementoNuevo.src="../imagenes/PagoExitoso.png";
            elementoNuevo.id="pago_exitoso";
            // Reemplaza el elemento antiguo con el nuevo
            elementoViejo.parentNode.replaceChild(elementoNuevo, elementoViejo);
            document.getElementById("desc_comp").removeAttribute("style");
            let cedula=document.getElementById("cedula");
            let nombre=document.getElementById("nombre");
            let direccion=document.getElementById("direccion");
            let telefono=document.getElementById("telefono");
            
            insertComprobante(document.getElementById("id_comprobante").value,document.getElementById("id_pedido").value,document.getElementById("total").innerHTML.match(/(\d+)/)[0], document.getElementById("fecha_entrega").value,document.getElementById("hora_entrega").value, cedula.value, nombre.value,direccion.value,telefono.value);
            telefono.disabled=true;
            direccion.disabled=true;
            nombre.disabled=true;
            cedula.disabled=true;
        });
    },
    onError: function (err) {
        // For example, redirect to a specific error page
        let elementoViejo = document.getElementById("paypal-button-container");

            // Crea el nuevo elemento
            let elementoNuevo = document.createElement("img");
            elementoNuevo.id="pago_erroneo";
            elementoNuevo.src="../imagenes/ErrorPago.png";

            // Reemplaza el elemento antiguo con el nuevo
            elementoViejo.parentNode.replaceChild(elementoNuevo, elementoViejo);
            
    }
}).render('#paypal-button-container');

function insertComprobante(id_comprobante_venta, id_pedido, total_pago, fecha_entrega, hora_entrega, cedula, nombre,direccion,telefono) {
    return new Promise((resolve, reject) => {
        fetch("../php/InsertarComprobante.php?&id_comprobante_venta=" + id_comprobante_venta + "&id_pedido=" + id_pedido + "&total_pago=" + total_pago+ "&fecha_entrega=" + fecha_entrega+ "&hora_entrega=" + hora_entrega+ "&cedula=" + cedula+ "&nombre=" + nombre+ "&direccion=" + direccion+ "&telefono=" + telefono)
            .catch(error => reject(error));
    });
}