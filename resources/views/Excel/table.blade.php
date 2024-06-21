<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>No Order</th>
            <th>Metode Pembayaran</th>
            <th>Total Pembayaran</th>
            <th>Status</th>
            <th>Tanggal Transaksi</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as  $data)


        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->order->order_number }}</td>
            <td>{{ $data->payment_method }}</td>
            <td>Rp{{ number_format($data->total_amount, 0, ',', '.') }}</td>
            <td>{{ $data->status }}</td>
            <td>{{ $data->order_date }}</td>

        </tr>

        @endforeach
    </tbody>
</table>
