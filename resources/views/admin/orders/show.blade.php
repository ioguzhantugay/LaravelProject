<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Sipariş Detayı #{{ $order->id }} | Yönetim Paneli</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Sipariş Detayı #{{ $order->id }}</h3>
        <a href="{{ route('admin.orders') }}" class="btn btn-secondary">← Geri Dön</a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card p-4 shadow-sm">
                <h5 class="text-primary mb-3">Müşteri Bilgileri</h5>
                <p><strong>İsim:</strong> {{ $order->name }} {{ $order->surname }}</p>
                <p><strong>Telefon:</strong> {{ $order->phone }}</p>
                <p><strong>Ödeme Yöntemi:</strong> {{ $order->payment_method == 'kart' ? 'Kredi Kartı' : 'Kapıda Ödeme' }}</p>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card p-4 shadow-sm">
                <h5 class="text-primary mb-3">Teslimat Adresi</h5>
                <p><strong>İl/İlçe:</strong> {{ $order->district }} / {{ $order->city }}</p>
                <p><strong>Detaylı Adres:</strong> {{ $order->address_detail }}</p>
            </div>
        </div>
    </div>

    <div class="card mt-4 p-4 shadow-sm">
        <h5 class="mb-3">Sipariş Edilen Ürünler</h5>
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Ürün Adı</th>
                    <th>Adet</th>
                    <th>Birim Fiyat</th>
                    <th>Toplam</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_title }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }} ₺</td>
                    <td>{{ number_format($item->price * $item->quantity, 2) }} ₺</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <h4>Genel Toplam: {{ number_format($order->total_amount, 2) }} ₺</h4>
        </div>
    </div>
</div>

</body>
</html>