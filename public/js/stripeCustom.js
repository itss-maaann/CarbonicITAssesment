const stripe = Stripe(stripeKey);
const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#card-element');

const paymentForm = document.getElementById('payment-form');
const messageModal = document.getElementById('message-modal');
const modalHeaderText = document.getElementById('modal-header-text');
const modalBodyText = document.getElementById('modal-body-text');

paymentForm.addEventListener('submit', async (event) => {
    event.preventDefault();

    const email = document.getElementById('email').value;
    const amount = document.getElementById('amount').value;
    const gateway = document.getElementById('gatway').value;

    const response = await fetch(paymentCreateUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ email, amount, gateway }),
    });

    const result = await response.json();

    if (result.clientSecret) {
        const { error, paymentIntent } = await stripe.confirmCardPayment(result.clientSecret, {
            payment_method: {
                card: cardElement,
                billing_details: {
                    email: email,
                },
            }
        });

        if (error) {
            showModal('Payment Error', 'Payment failed: ' + error.message);
        } else if (paymentIntent.status === 'succeeded') {
            showModal('Payment Successful', 'Payment succeeded!');

            const paymentId = paymentIntent.id;
            const confirmationResponse = await fetch(`/payment/confirm/${paymentId}`);

            const confirmationResult = await confirmationResponse.json();

            if (confirmationResult.status === 'succeeded') {
                showModal('Payment Confirmation', 'Payment confirmed as succeeded in the system.');
                // Clear the input fields after successful payment
                document.getElementById('email').value = '';
                document.getElementById('amount').value = '';
                cardElement.clear(); // Clears the card input element
            } else {
                showModal('Payment Error', 'Payment confirmation failed.');
            }
        }
    }
});

function showModal(header, body) {
    modalHeaderText.textContent = header;
    modalBodyText.textContent = body;
    messageModal.style.display = 'block';
}

function closeModal() {
    messageModal.style.display = 'none';
}
