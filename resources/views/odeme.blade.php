<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ödeme | Akvaryum Dünyası</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .payment-box { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-light">

<div class="container my-5">
    <form action="/siparis-tamamla" method="POST">
        @csrf
        <input type="hidden" name="payment_method" value="{{ $method }}">
        
        <div class="row">
            <div class="col-md-7">
                <div class="payment-box">
                    <h5 class="mb-4 text-primary">Teslimat ve İletişim Bilgileri</h5>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Ad</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Soyadı</label>
                            <input type="text" name="surname" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Telefon Numarası</label>
                        <input type="tel" name="phone" class="form-control" placeholder="05xx xxx xx xx" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>İl</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>İlçe</label>
                            <input type="text" name="district" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Detaylı Adres</label>
                        <textarea name="address_detail" class="form-control" rows="2" required></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="payment-box">
                    @if($method == 'kart')
                        <h5 class="text-primary">Kart Bilgileri</h5>
                        <div class="form-group"><label>Kart Numarası</label><input type="text" class="form-control" placeholder="0000 0000 0000 0000"></div>
                        <div class="row">
                            <div class="col-6"><label>AA/YY</label><input type="text" class="form-control"></div>
                            <div class="col-6"><label>CVV</label><input type="text" class="form-control"></div>
                        </div>
                    @else
                        <h5 class="text-success"><i class="fas fa-truck"></i> Kapıda Ödeme</h5>
                        <p class="text-muted">Ödemenizi teslimat sırasında nakit veya kart ile yapabilirsiniz.</p>
                    @endif
                    
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block mt-4">Siparişi Onayla</button>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>