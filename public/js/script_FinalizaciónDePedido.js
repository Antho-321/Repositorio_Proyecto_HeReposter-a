paypal.Buttons({
    // Configura la transacción cuando se hace clic en un botón de pago
    createOrder: (data, actions) => {

        return actions.order.create({
            purchase_units: [{
                items: [
                    {
                        name: 'pastel de vísperas de santos',
                        quantity: '1',
                        unit_amount: {
                            currency_code: 'USD',
                            value: '25.00'
                        }
                    },
                    {
                        name: 'pastel de cumpleaños',
                        quantity: '3',
                        unit_amount: {
                            currency_code: 'USD',
                            value: '25.00'
                        }
                    }
                ],
                amount: {
                    currency_code: 'USD',
                    value: '100.00', // También puede hacer referencia a una variable o función.
                    breakdown: {
                        item_total: {
                            currency_code: 'USD',
                            value: '100.00'
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
            
            // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            
            const transaction = orderData.purchase_units[0].payments.captures[0];
            // Obtén el elemento antiguo
            let elementoViejo = document.getElementById("paypal-button-container");

            // Crea el nuevo elemento
            let elementoNuevo = document.createElement("img");
            elementoNuevo.src="images/PagoExitoso.png";
            elementoNuevo.id="pago_exitoso";
            // Reemplaza el elemento antiguo con el nuevo
            elementoViejo.parentNode.replaceChild(elementoNuevo, elementoViejo);
            document.getElementById("desc_comp").removeAttribute("style");
            let cedula=document.getElementById("cedula");
            let nombre=document.getElementById("nombre");
            let direccion=document.getElementById("direccion");
            let telefono=document.getElementById("telefono");
            
            console.log("pedido id: "+document.getElementById("id_pedido").value);

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
            elementoNuevo.src="images/ErrorPago.png";

            // Reemplaza el elemento antiguo con el nuevo
            elementoViejo.parentNode.replaceChild(elementoNuevo, elementoViejo);
            
    }
}).render('#paypal-button-container');

function insertComprobante(id_comprobante_venta, id_pedido, total_pago, fecha_entrega, hora_entrega, cedula, nombre, direccion, telefono) {
    return new Promise((resolve, reject) => {
        fetch('/comprobante/insert', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                comprobante_id: id_comprobante_venta,
                pedido_id: id_pedido,
                // Assuming 'lugar', 'cantidad', and 'concepto' can be derived or are not required
                fecha: fecha_entrega,
                // You might need to handle 'hora_entrega', 'cedula', 'nombre', 'direccion', 'telefono' appropriately
            })
        })
        .then(response => response.json())
        .then(data => resolve(data))
        .catch(error => reject(error));
    });
}
