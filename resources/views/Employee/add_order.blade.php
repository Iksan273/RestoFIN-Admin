@extends('Layouts.user')
@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">Dashboard</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/"><i
                                                class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                <!-- [ Main Content ] start -->
                <div class="row">
                    <div class="col-lg-8 col-md-10 col-sm-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="makanan-tab" data-bs-toggle="tab" data-bs-target="#makanan" type="button" role="tab" aria-controls="makanan" aria-selected="true">Makanan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="minuman-tab" data-bs-toggle="tab" data-bs-target="#minuman" type="button" role="tab" aria-controls="minuman" aria-selected="false">Minuman</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="makanan" role="tabpanel" aria-labelledby="makanan-tab">
                                <div class="row overflow-auto" style="max-height: 800px;">
                                    @for ($i = 1; $i <= 15; $i++)
                                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                        <div class="card" onclick="addToCart({{ $i }}, 'Dummy Food {{ $i }}', 50000)">
                                            <img src="https://via.placeholder.com/50" class="card-img-top" alt="Dummy Food {{ $i }}">
                                            <div class="card-body">
                                                <h5 class="card-title">Dummy Food {{ $i }}</h5>
                                                <p class="card-text">Rp50.000</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="tab-pane fade" id="minuman" role="tabpanel" aria-labelledby="minuman-tab">
                                <div class="row overflow-auto" style="max-height: 400px;">
                                    @for ($i = 1; $i <= 5; $i++)
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                        <div class="card" onclick="addToCart({{ $i+5 }}, 'Dummy Drink {{ $i }}', 20000)">
                                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Dummy Drink {{ $i }}">
                                            <div class="card-body">
                                                <h5 class="card-title">Dummy Drink {{ $i }}</h5>
                                                <p class="card-text">Rp20.000</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Keranjang</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group cart-items">
                                    <!-- Cart items will be added here dynamically -->
                                </ul>
                                <p class="mt-3">Total: Rp<span class="total-price">0</span></p>
                                <button class="btn btn-success mt-2" id="submit-order">Submit Order</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- [ Main Content ] end -->
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartItems = document.querySelector('.cart-items');
        const totalPriceElement = document.querySelector('.total-price');
        let totalPrice = 0;
        let cart = {};

        window.addToCart = function (id, name, price) {
            if (!cart[id]) {
                cart[id] = { name, price, quantity: 1 };
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center', 'mb-2', 'shadow-sm');
                listItem.id = `item-${id}`;
                listItem.innerHTML = `<div><img src="https://via.placeholder.com/50" class="rounded-circle" alt="Icon ${name}">${name} - Rp${price.toLocaleString()}</div> <div><button class="btn btn-danger btn-sm" onclick="changeQuantity(${id}, -1)">-</button> <span id="qty-${id}" class="badge bg-primary rounded-pill">${cart[id].quantity}</span> <button class="btn btn-success btn-sm" onclick="changeQuantity(${id}, 1)">+</button></div>`;
                cartItems.appendChild(listItem);
                updateCartTotal(); // Memperbarui total saat item baru ditambahkan
            } else {
                cart[id].quantity++;
                document.getElementById(`qty-${id}`).textContent = cart[id].quantity;
                updateCartTotal(); // Memperbarui total setiap kali kuantitas item diubah
            }
        };

        window.changeQuantity = function (id, change) {
            if (cart[id].quantity + change > 0) {
                cart[id].quantity += change;
                document.getElementById(`qty-${id}`).textContent = cart[id].quantity;
                updateCartTotal(); // Memperbarui total setiap kali kuantitas item diubah
            }
        };

        function updateCartTotal() {
            totalPrice = 0;
            Object.values(cart).forEach(item => {
                totalPrice += item.price * item.quantity;
            });
            const taxPrice = totalPrice * 0.1;
            const totalPay = totalPrice + taxPrice;
            totalPriceElement.innerHTML = `Total Harga: Rp${totalPrice.toLocaleString()}<br>PPN (10%): Rp${taxPrice.toLocaleString()}<br>Total Bayar: Rp${totalPay.toLocaleString()}`;
        }

        document.getElementById('submit-order').addEventListener('click', function () {
            alert('Order submitted!');
            // Here you would typically handle the order submission logic
        });
    });
</script>
