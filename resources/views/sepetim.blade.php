<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Sepetim | Akvaryum Dünyası</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .cart-card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .cart-img { width: 70px; height: 70px; object-fit: cover; border-radius: 8px; }
        .method-box { background: #fff; border-radius: 10px; padding: 20px; border: 1px solid #eee; }
        .btn-trendyol { background-color: #f27a1a; color: white; font-weight: 600; }
        .btn-success-custom { background-color: #28a745; color: white; font-weight: 600; }
    </style>
</head>
<body>

<div class="container mt-5">
    @if(session('error')) <div class="alert alert-danger text-center">{{ session('error') }}</div> @endif
    @if(session('success')) <div class="alert alert-success text-center">{{ session('success') }}</div> @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card cart-card p-4 shadow-sm">
                <h4 class="mb-4">Sepetim ({{ count(session('cart', [])) }} Ürün)</h4>
                @if(session('cart'))
                    @foreach(session('cart') as $id => $item)
                    <div class="row align-items-center mb-3 border-bottom pb-3">
                        <div class="col-2"><img src="{{ asset($item['image']) }}" class="cart-img"></div>
                        <div class="col-4"><strong>{{ $item['title'] }}</strong></div>
                        <div class="col-2">{{ $item['quantity'] }} Adet</div>
                        <div class="col-2 text-primary font-weight-bold">{{ number_format($item['price'] * $item['quantity'], 2) }} ₺</div>
                        <div class="col-2"><a href="/cart/remove/{{$id}}" class="btn btn-sm btn-outline-danger">Sil</a></div>
                    </div>
                    @endforeach
                    <h4 class="text-right mt-3">Toplam: {{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, session('cart', []))), 2) }} ₺</h4>
                @else
                    <p class="text-center py-4">Sepetiniz boş. <a href="/">Alışverişe devam edin!</a></p>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="method-box shadow-sm">
                <h5>Ödeme Yöntemini Seçin</h5>
                <hr>
                @if(!empty(session('cart')))
                    <a href="/odeme?method=kart" class="btn btn-trendyol btn-block mb-3">
                        Kredi Kartı ile Öde
                    </a>
                    <a href="/odeme?method=kapida" class="btn btn-success-custom btn-block">
                        Kapıda Ödeme ile Devam Et
                    </a>
                @else
                    <p class="text-muted">Sepetiniz boş, işlem yapılamaz.</p>
                @endif
            </div>
        </div>
    </div>
</div>

</body>
</html>