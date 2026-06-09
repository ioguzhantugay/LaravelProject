<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Akvaryum Dünyası | Modern Mağaza</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="/">Akvaryum Dünyası</a>
        <div class="navbar-nav ml-auto flex-row align-items-center">
            
            <a href="/sepetim" class="btn btn-warning btn-sm mr-3 font-weight-bold">Sepetim</a>
            
            @auth
                <a href="/admin/products" class="btn btn-outline-light btn-sm mr-2">Admin Paneli</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Çıkış Yap</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm mr-2">Giriş</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Kayıt Ol</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row mb-5">
        <div class="col-md-6 offset-md-3">
            <form action="/" method="GET" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Ürün ara..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Ara</button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center mb-5">
        <a href="/" class="btn btn-outline-primary m-1">Tümü</a>
        @if(isset($categories))
            @foreach($categories as $category)
                <a href="/?category={{$category->id}}" class="btn btn-outline-primary m-1">{{ $category->name }}</a>
            @endforeach
        @endif
    </div>

    <h2 class="mb-4 font-weight-bold">Ürünler</h2>
    
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
                    <a href="/cart/add/{{$product->id}}" class="btn btn-primary btn-block rounded-pill">Sepete Ekle</a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>

</body>
</html>