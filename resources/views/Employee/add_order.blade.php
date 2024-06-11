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
                                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a>
                                        </li>
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
                                @foreach ($categories as $category)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link @if ($loop->first) active @endif"
                                            id="{{ 'tab-' . $category->id }}" data-bs-toggle="tab"
                                            data-bs-target="{{ '#content-' . $category->id }}" type="button" role="tab"
                                            aria-controls="{{ 'content-' . $category->id }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $category->title }}</button>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @foreach ($categories as $category)
                                    <div class="tab-pane fade @if ($loop->first) show active @endif"
                                        id="{{ 'content-' . $category->id }}" role="tabpanel"
                                        aria-labelledby="{{ 'tab-' . $category->id }}">
                                        <div class="row overflow-auto" style="max-height: 800px;">
                                            @foreach ($category->menus as $menu)
                                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                                    <div class="card"
                                                        onclick="addToCart({{ $menu->id }}, '{{ $menu->title }}', {{ $menu->price }})">
                                                        <img src="{{ asset('menu/images/' . $menu->imageUrl) }}"
                                                            class="card-img-top img-fluid" alt="{{ $menu->title }}">
                                                        <div class="card-body">
                                                            <p class="card-title" style="font-size: small">{{ $menu->title }}</p>
                                                            <p class="card-text" style="font-size: small">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Keranjang</h5>
                                </div>
                                <div class="card-body" style="overflow-y: auto; max-height: 300px;">
                                    <ul class="list-group cart-items">
                                        <!-- Cart items will be added here dynamically -->
                                    </ul>
                                    <p class="mt-3">Total: Rp<span class="total-price">0</span></p>

                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is-member"
                                            onchange="toggleMemberForm()">
                                        <label class="form-check-label" for="is-member">Centang Jika Member</label>
                                    </div>
                                    <div id="member-form" style="display: none;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="member-phone"
                                                placeholder="Masukkan Nomor Telepon">
                                            <button class="btn btn-primary" id="checkMemberBtn">Cek Member</button>
                                        </div>
                                        <div id="memberInfo" style="margin-top: 10px;s"></div>
                                    </div>
                                    <div id="non-member-form" style="display: none;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="customer-name"
                                                placeholder="Masukkan Nama">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">No Meja:</label>
                                        <input type="Number" class="form-control" id="table-number"
                                            placeholder="Masukkan Nomor Meja">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success mt-2" id="submit-order">Submit Order</button>

                        </div>
                    </div>

                    <!-- [ Main Content ] end -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const cartItems = document.querySelector('.cart-items');
            const totalPriceElement = document.querySelector('.total-price');
            let totalPrice = 0;
            let totalPay = 0;
            let cart = {};


            window.addToCart = function(id, name, price) {
                if (!cart[id]) {
                    cart[id] = {
                        name,
                        price,
                        quantity: 1
                    };
                    const listItem = document.createElement('li');
                    listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between',
                        'align-items-center', 'mb-2', 'shadow-sm');
                    listItem.id = `item-${id}`;
                    listItem.innerHTML =
                        `<div>${name} - Rp${price.toLocaleString()}</div> <div><button class="btn btn-danger btn-sm" onclick="changeQuantity(${id}, -1)">-</button> <span id="qty-${id}" class="badge bg-primary rounded-pill">${cart[id].quantity}</span> <button class="btn btn-success btn-sm" onclick="changeQuantity(${id}, 1)">+</button></div>`;
                    cartItems.appendChild(listItem);
                    updateCartTotal(); // Memperbarui total saat item baru ditambahkan
                } else {
                    cart[id].quantity += 1;
                    document.getElementById(`qty-${id}`).textContent = cart[id].quantity;
                    updateCartTotal(); // Memperbarui total setiap kali kuantitas item diubah
                }
            };

            window.changeQuantity = function(id, change) {
                if (cart[id].quantity + change > 0) {
                    cart[id].quantity += change;
                    document.getElementById(`qty-${id}`).textContent = cart[id].quantity;
                    updateCartTotal(); // Memperbarui total setiap kali kuantitas item diubah
                } else {
                    delete cart[id];
                    document.getElementById(`item-${id}`).remove();
                    updateCartTotal(); // Memperbarui total setelah item dihapus dari cart
                }
            };

            function updateCartTotal() {
                totalPrice = 0;
                Object.values(cart).forEach(item => {
                    totalPrice += item.price * item.quantity;
                });
                const taxPrice = totalPrice * 0.1;
                totalPay = totalPrice + taxPrice;
                totalPriceElement.innerHTML =
                    `Total Harga: Rp${totalPrice.toLocaleString()}<br>PPN (10%): Rp${taxPrice.toLocaleString()}<br>Total Bayar: Rp${totalPay.toLocaleString()}`;
            }

            document.getElementById('submit-order').addEventListener('click', function() {
                const no_meja = parseInt($('#table-number').val());
                let member_id_text = $('#idMember').text();
                let member = member_id_text.replace('ID:', '').trim();
                const member_id = parseInt(member);
                const customer_name = $('#customer-name').val();
                const orderData = {
                    no_meja,
                    customer_name,
                    member_id,
                    total_price: totalPay,
                    cart: cart,
                };
                console.log(orderData);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                $.ajax({
                    url: '{{ route('employee.StoreOrder') }}',
                    type: 'POST',
                    data: JSON.stringify(orderData),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        alert('Order submitted successfully!');
                        window.location.href = "/daftar-pesanan-pending";
                    },
                    error: function(xhr, status, error) {
                        alert('Error submitting order');
                    }
                });
            });
        });
    </script>
    <script>
        function toggleMemberForm() {
            const isMemberCheckbox = document.getElementById('is-member');
            const memberForm = document.getElementById('member-form');
            const nonMemberForm = document.getElementById('non-member-form');

            if (isMemberCheckbox.checked) {
                memberForm.style.display = 'block';
                nonMemberForm.style.display = 'none';
            } else {
                memberForm.style.display = 'none';
                nonMemberForm.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleMemberForm();
        });
        document.getElementById('is-member').addEventListener('change', toggleMemberForm);
    </script>
    <script>
        $(document).ready(function() {
            $('#checkMemberBtn').click(function() {
                var phone = $('#member-phone').val();
                if (!phone) {
                    $('#memberInfo').html(
                        '<div class="alert alert-warning">Harap masukkan nomor telepon.</div>');
                    return;
                }
                $.ajax({
                    url: '{{ route('fetch-user') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        phone: phone
                    },
                    success: function(response) {

                        $('#memberInfo').html('<p id="idMember" >ID:' + response.id +
                            '</p><p id="name">Nama: ' + response.name +
                            '</p><p id="email">Email: ' + response.email +
                            '</p><p id="points">Poin: ' + response.points + '</p>');

                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            if (xhr.status === 404) {
                                $('#memberInfo').html('<div class="alert alert-warning">' +
                                    'Member tidak ditemukan.' + '</div>');
                            } else {
                                $('#memberInfo').html('<div class="alert alert-danger">' +
                                    xhr.responseJSON.error + '</div>');
                            }
                        } else {
                            $('#memberInfo').html(
                                '<div class="alert alert-danger">Gagal mengambil data dari server.</div>'
                            )
                        };
                    }
                });
            });
        });
    </script>
@endsection
