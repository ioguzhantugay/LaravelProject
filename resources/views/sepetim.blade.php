<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim | Xeplin Petshop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .navbar { background: #0056b3; }
        .cart-card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); background: white; }
        .summary-card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); background: white; position: sticky; top: 20px; }
        .price-text { color: #0056b3; font-weight: 700; font-size: 1.1rem; }
        .total-text { color: #0056b3; font-weight: 800; font-size: 1.5rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-5">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="/">Xeplin Petshop</a>
        <div class="navbar-nav ml-auto flex-row align-items-center">
            <a href="/" class="btn btn-outline-light btn-sm mr-3">Alışverişe Dön</a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm mr-2 font-weight-bold">Yönetim</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container">
    <h2 class="font-weight-bold mb-4 text-dark">🛒 Alışveriş Sepetim</h2>
    
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card cart-card p-3">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover mb-0">
                        <thead class="border-bottom">
                            <tr>
                                <th>Ürün Adı</th>
                                <th>Fiyat</th>
                                <th class="text-right">İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Fiyatları toplamak için başlangıç değişkeni --}}
                            @php $toplamTutar = 0; @endphp
                            
                            @if(isset($cartItems) && $cartItems->count() > 0)
                                @foreach($cartItems as $item)
                                    {{-- Her dönüşte ürünün fiyatını adetiyle çarpıp toplama ekliyoruz --}}
                                    @php $toplamTutar += ($item->price * $item->quantity); @endphp
                                    
                                    <tr class="border-bottom">
                                        <td class="align-middle">
                                            <h6 class="font-weight-bold mb-0">{{ $item->title }}</h6>
                                            {{-- ADET BİLGİSİ EKLENDİ --}}
                                            <small class="text-muted font-weight-bold">Adet: {{ $item->quantity }}</small>
                                        </td>
                                        
                                        {{-- FİYAT KISMI ADET İLE ÇARPILARAK DÜZENLENDİ --}}
                                        <td class="align-middle price-text">
                                            {{ number_format($item->price * $item->quantity, 2) }} ₺
                                        </td>
                                        
                                        <td class="align-middle text-right">
                                            <a href="/cart/remove/{{ $item->id }}" class="btn btn-sm btn-outline-danger rounded-pill px-3">Sil</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <h5 class="text-muted">Sepetiniz şu an boş.</h5>
                                        <a href="/" class="btn btn-primary rounded-pill mt-2">Hemen Alışverişe Başla</a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card summary-card p-4">
                <h5 class="font-weight-bold border-bottom pb-3 mb-4">Sipariş Özeti</h5>
                
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted font-weight-bold">Ara Toplam</span>
                    <span class="font-weight-bold">{{ number_format($toplamTutar, 2) }} ₺</span>
                </div>
                
                <div class="d-flex justify-content-between mb-4">
                    <span class="text-muted font-weight-bold">Kargo Ücreti</span>
                    <span class="text-success font-weight-bold">Ücretsiz</span>
                </div>
                
                <div class="d-flex justify-content-between border-top pt-4 mb-4">
                    <span class="font-weight-bold text-dark h5 mb-0">Genel Toplam</span>
                    <span class="total-text">{{ number_format($toplamTutar, 2) }} ₺</span>
                </div>
                
                <a href="/odeme" class="btn btn-success btn-block rounded-pill font-weight-bold py-3 shadow-sm">
                    Alışverişi Tamamla
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>