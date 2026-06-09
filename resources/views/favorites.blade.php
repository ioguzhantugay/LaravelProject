<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Favorilerim | Xeplin Petshop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .product-card { border: none; border-radius: 15px; overflow: hidden; background: white; transition: 0.3s; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>❤️ Favorilerim</h2>
        <a href="/" class="btn btn-outline-primary">← Alışverişe Dön</a>
    </div>
    
    <div class="row">
        @forelse($favorites as $fav)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card product-card h-100 shadow-sm">
                <img src="{{ asset($fav->product->image) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                <div class="card-body text-center">
                    <h6 class="font-weight-bold">{{ $fav->product->title }}</h6>
                    <p class="text-primary font-weight-bold">{{ number_format($fav->product->price, 2) }} ₺</p>
                    <form action="{{ route('favorites.toggle', $fav->product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger rounded-pill">Favorilerden Kaldır</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center py-5">
                <h4 class="text-muted">Henüz favori ürünün yok.</h4>
                <a href="/" class="btn btn-primary mt-3">Alışverişe Başla</a>
            </div>
        @endforelse
    </div>
</div>
</body>
</html>