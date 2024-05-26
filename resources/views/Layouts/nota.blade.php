<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Order</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .item-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
        }
        .item-name {
            flex: 1; /* Flexibility to take necessary width */
            text-align: left;
        }
        .item-price {
            width: 120px; /* Fixed width for price */
            text-align: right;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="text-center mb-4">ORDERAN #{{ $order->order_number }}</h4>
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-unstyled">
                        <li><strong>Nama:</strong> {{ $order->user->firstname }} {{ $order->user->lastname}}</li>
                        <li><strong>No Meja:</strong> {{ $order->no_meja }}</li>
                        <li><strong>Tanggal:</strong> {{ $order->order_date }}</li>
                    </ul>
                </div>
            </div>
            <hr>
            @foreach ($order->orderItems as $item)
            <div class="item-row">
                <div class="item-name">{{ $item->menu->title }}</div>
                <div class="item-price">Jumlah : {{$item->jumlah}}</div>
            </div>
            @endforeach
            <hr>

        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

