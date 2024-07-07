<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 48mm;
            margin: 0;
            padding: 0;
        }
        .receipt {
            padding: 5mm;
        }
        .header, .footer {
            text-align: center;
        }
        .content {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1>{{ $store_name }}</h1>
            <p>{{ $store_address }}</p>
            <p>Phone: {{ $store_phone }}</p>
            <p>Email: {{ $store_email }}</p>
            <p>Website: {{ $store_website }}</p>
        </div>
        <div class="content">
            <p>Transaction ID: {{ $transaction_id }}</p>
            <p>Meja: {{ $meja }}</p>
            <pre>
@foreach($formatted_items as $item)
{{ $item }}
@endforeach
            </pre>
            <p>Subtotal: {{ number_format($subtotal, 2) }}</p>
            <p>Tax ({{ $tax_percentage }}%): {{ number_format($tax, 2) }}</p>
            <p>Total: {{ number_format($grand_total, 2) }}</p>
        </div>
        <div class="footer">
            <p>Thank you for your purchase!</p>
        </div>
    </div>
</body>
</html>
