paypal.Buttons({
    createOrder: function(data, actions) {
        const email = document.getElementById('email').value;
        const amount = document.getElementById('amount').value;

        if (!email || !amount) {
            alert('Please enter both email and amount.');
            return;
        }

        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: amount
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name);
        });
    },
    onError: function(err) {
        console.error('PayPal Error:', err);
    }
}).render('#paypal-button-container');
