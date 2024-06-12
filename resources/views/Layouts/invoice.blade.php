<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Order</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .receipt {
            max-width: 300px;
            margin: auto;
            padding: 1rem;
            border: 1px solid #ddd;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .receipt-header, .receipt-footer {
            text-align: center;
            margin-bottom: 1rem;
        }
        .receipt-item {
            margin: 0.5rem 0;
        }
        .receipt-item-title {
            font-weight: bold;
            margin-bottom: 0.2rem;
        }
        .receipt-item-detail {
            display: flex;
            justify-content: space-between;
        }
        .receipt-total, .receipt-change {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            font-weight: bold;
        }
        .receipt-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="receipt">
    <div class="receipt-header">
        <div class="receipt-title">Vinkopi</div>
        <div>Vin Gallery Art & Resto</div>
        <div>Vinautism Gallery</div>
        <div>Gwalk junction</div>
        <div>TL6 no 11</div>
        <div>08123032006</div>
    </div>
    <div>
        <div>{{ $order['order_date'] }}</div>
        <div>{{ date('H:i', strtotime($order['order_date'])) }}</div>
        <div>Transaksi {{ $order['order_number'] }}</div>
        <div>Kasir: {{ $order['kasir'] }}</div>
    </div>
    <hr>
    @foreach ($order['orderItems'] as $item)
    <div class="receipt-item">
        <div class="receipt-item-title">{{ $item['menu']['title'] }}</div>
        <div class="receipt-item-detail">
            <div>{{ $item['jumlah'] }}x {{ number_format($item['menu']['price'], 0, ',', '.') }}</div>
            <div>{{ number_format($item['jumlah'] * $item['menu']['price'], 0, ',', '.') }}</div>
        </div>
    </div>
    @endforeach
    <hr>
    <div class="receipt-item">
        <div>Subtotal</div>
        <div>{{ number_format($order['total_price'] - ($order['total_price'] * 0.1), 0, ',', '.') }}</div>
    </div>
    <div class="receipt-item">
        <div>Pajak 10%</div>
        <div>{{ number_format($order['total_price'] * 0.1, 0, ',', '.') }}</div>
    </div>
    <div class="receipt-total">
        <div>Total</div>
        <div>{{ number_format($order['total_price'], 0, ',', '.') }}</div>
    </div>
    <div class="receipt-item">
        <div>TUNAI</div>
        {{-- <div>{{ number_format($order['cash'], 0, ',', '.') }}</div> --}}
    </div>
    <div class="receipt-change">
        <div>Kembalian</div>
        {{-- <div>{{ number_format($order['change'], 0, ',', '.') }}</div> --}}
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
