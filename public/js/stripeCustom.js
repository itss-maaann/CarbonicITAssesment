const stripe = Stripe(stripeKey);
const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#card-element');

const paymentForm = document.getElementById('payment-form');
const messageModal = document.getElementById('message-modal');
const modalHeaderText = document.getElementById('modal-header-text');
const modalBodyText = document.getElementById('modal-body-text');
const loadingOverlay = document.getElementById('loading-overlay');

document.addEventListener('DOMContentLoaded', function () {
    messageModal.style.display = 'none';
    loadingOverlay.style.display = 'none';
});

paymentForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    showLoader();

    const email = document.getElementById('email').value;
    const amount = document.getElementById('amount').value;
    const gateway = document.getElementById('gateway').value;
    const order_id = document.getElementById('order_id').value;

    const response = await fetch(paymentCreateUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ email, amount, gateway, order_id }),
    });

    if (response.redirected) {
        console.log('Redirect detected to:', response.url);
        showModal('Payment Error', 'Unexpected redirect occurred. Please try again.');
        hideLoader();
        return;
    }

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
            hideLoader();
        } else if (paymentIntent.status === 'succeeded') {
            showModal('Payment Successful', 'Payment succeeded!');

            const paymentId = paymentIntent.id;
            const confirmationResponse = await fetch('/payment/confirm', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ paymentId, order_id }),
            });

            const confirmationResult = await confirmationResponse.json();

            if (confirmationResult.status === 'succeeded') {
                showModal('Payment Confirmation', 'Payment confirmed as succeeded in the system.');
            } else {
                showModal('Payment Error', 'Payment confirmation failed.');
            }
            hideLoader();
        }
    } else {
        showModal('Payment Error', 'Failed to create payment intent.');
        hideLoader();
    }
});

function showModal(header, body) {
    modalHeaderText.textContent = header;
    modalBodyText.textContent = body;
    messageModal.style.display = 'flex';

    if (header === 'Payment Confirmation') {
        document.querySelector('.close-btn').onclick = function() {
            window.location.href = '/orders';
        };
    } else {
        document.querySelector('.close-btn').onclick = closeModal;
    }
}

function closeModal() {
    messageModal.style.display = 'none';
}

function showLoader() {
    loadingOverlay.style.display = 'flex';
}

function hideLoader() {
    loadingOverlay.style.display = 'none';
}
