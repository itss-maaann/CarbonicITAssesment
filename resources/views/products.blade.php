@extends('layouts.layout')

@section('title', 'Available Products')

@section('content')
    <div class="home-content">
        <h1>Available Products</h1>

        <button class="continue-button" id="add-product-button">Add Product</button>

        <hr>

        <div id="products-container">
            @if(empty($products))
                <p>No products available at the moment.</p>
            @else
                @foreach($products as $product)
                    <div class="product-item card">
                        <h3>{{ $product['name'] }}</h3>
                        <p>Price: ${{ $product['price'] }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div id="add-product-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add Product</h2>
            </div>
            <div class="modal-body">
                <form id="add-product-form" action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="product-name">Product Name</label>
                        <input type="text" name="name" id="product-name" placeholder="Enter Product Name" required>
                        <div class="error" id="name-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="product-price">Product Price (USD)</label>
                        <input type="number" name="price" id="product-price" placeholder="Enter Product Price" required min="0.01">
                        <div class="error" id="price-error"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="close-btn" onclick="closeAddProductModal()">Close</button>
                <button class="continue-button" id="submit-product-form">Create</button>
            </div>
        </div>
    </div>

    <div id="message-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header" id="modal-header-text"></div>
            <div class="modal-body" id="modal-body-text"></div>
            <button class="close-btn" onclick="closeModal()">Close</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const addProductButton = document.getElementById('add-product-button');
    const submitProductFormButton = document.getElementById('submit-product-form');
    const addProductModal = document.getElementById('add-product-modal');
    const addProductForm = document.getElementById('add-product-form');
    const nameField = document.getElementById('product-name');
    const priceField = document.getElementById('product-price');
    const nameError = document.getElementById('name-error');
    const priceError = document.getElementById('price-error');

    const messageModal = document.getElementById('message-modal');
    const closeMessageModalButton = document.querySelector('#message-modal .close-btn');

    addProductModal.style.display = 'none';
    messageModal.style.display = 'none';

    addProductButton.addEventListener('click', () => {
        addProductModal.style.display = 'flex';
    });

    // Close Add Product Modal
    function closeAddProductModal() {
        addProductModal.style.display = 'none';
    }

    const closeButtons = document.querySelectorAll('.close-btn');
    closeButtons.forEach(button => {
        button.addEventListener('click', closeAddProductModal);
    });

    function validateForm() {
        let valid = true;
        if (nameField.value.trim() === '') {
            nameError.innerText = 'Product name is required.';
            valid = false;
        } else {
            nameError.innerText = '';
        }

        if (priceField.value.trim() === '' || priceField.value <= 0) {
            priceError.innerText = 'Product price must be valid and greater than zero.';
            valid = false;
        } else {
            priceError.innerText = '';
        }
        return valid;
    }

    submitProductFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        if (validateForm()) {
            addProductForm.submit();
        }
    });

    function closeModal() {
        messageModal.style.display = 'none';
    }

    closeMessageModalButton.addEventListener('click', closeModal);

    @if(session('success'))
        showModal('Success', '{{ session('success') }}');
    @endif

    function showModal(headerText, bodyText) {
        document.getElementById('modal-header-text').innerText = headerText;
        document.getElementById('modal-body-text').innerText = bodyText;
        messageModal.style.display = 'flex';
    }
});
    </script>
@endsection
