
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
            document.getElementById("pago_exitoso").parentElement.insertAdjacentHTML("afterend",`
            <button  id="desc_fact" onclick="DescargarComprobante()"><a>Descargar comprobante de venta</a></button>
            `);
            // Cuando esté listo para comenzar, elimine la alerta y muestre un mensaje de éxito dentro de esta página. Por ejemplo:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>¡Gracias por su pago!</h3>';
            // O vaya a otra URL: actions.redirect('thank_you.html');
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



