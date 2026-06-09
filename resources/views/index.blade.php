<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Akvaryum Dünyası | Modern Mağaza</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .navbar { background: linear-gradient(90deg, #0056b3, #003d82); }
        .product-card { border: none; border-radius: 15px; transition: 0.3s; }
        .product-card:hover { transform: translateY(-10px); box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important; }
        .card-img-top { border-top-left-radius: 15px; border-top-right-radius: 15px; height: 220px; object-fit: cover; }
        .badge-category { background-color: #e9ecef; color: #0056b3; font-weight: 600; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; }
        .price-text { color: #0056b3; font-weight: 700; font-size: 1.2rem; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="/">Akvaryum Dünyası</a>
        <div>
            <a href="/admin/products" class="btn btn-outline-light btn-sm">Yönetim Paneli</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4 font-weight-bold">Öne Çıkan Ürünlerimiz</h2>
    
    <div class="row">
        @foreach($products as $product)
        @if($product->status == 'True')
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card product-card shadow-sm h-100">
                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->title }}">
                <div class="card-body">
                    <span class="badge-category mb-2 d-inline-block">
                        {{ $product->category ? $product->category->name : 'Genel' }}
                    </span>
                    <h5 class="card-title font-weight-bold">{{ $product->title }}</h5>
                    <p class="price-text">{{ $product->price }} ₺</p>
                </div>
                <div class="card-footer bg-white border-0 pb-3">
                    <button class="btn btn-primary btn-block rounded-pill">Sepete Ekle</button>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>

</body>
</html>