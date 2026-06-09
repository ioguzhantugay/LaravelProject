<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xeplin Petshop | Kaliteli Akvaryum ve Evcil Hayvan Ürünleri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .navbar { background: #0056b3; }
        .hero-section { background: linear-gradient(135deg, #0056b3, #00d2ff); color: white; padding: 40px 0 30px 0; border-bottom-left-radius: 50px; border-bottom-right-radius: 50px; margin-bottom: 50px; }
        
        .hero-category-link { display: inline-block; padding: 6px 18px; margin: 4px; border: 1px solid rgba(255,255,255,0.4); border-radius: 20px; color: white; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease; }
        .hero-category-link:hover, .hero-category-link.active { background-color: white; color: #0056b3; text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        
        .product-card { border: none; border-radius: 15px; overflow: hidden; transition: 0.3s; background: white; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-img-top { height: 180px; object-fit: cover; }
        .price-text { color: #0056b3; font-weight: 700; font-size: 1.1rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="/">Xeplin Petshop</a>
        <div class="navbar-nav ml-auto flex-row align-items-center">
            
            <div class="btn-group mr-3 shadow-sm" role="group">
                <a href="/sepetim" class="btn btn-warning btn-sm font-weight-bold d-flex align-items-center">
                    🛒 Sepetim
                </a>
                <span class="btn btn-light btn-sm font-weight-bold text-dark d-flex align-items-center" style="border: 1px solid #ffc107; cursor: default;">
                    {{ isset($cartTotal) ? number_format($cartTotal, 2) : '0.00' }} ₺
                </span>
            </div>

            @auth
                <a href="{{ route('favorites.index') }}" class="btn btn-outline-light btn-sm mr-2 font-weight-bold">Favorilerim</a>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-light btn-sm mr-2 font-weight-bold">Profilim</a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm mr-2 font-weight-bold">Admin Paneli</a>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
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

<div class="hero-section text-center">
    <h1 class="font-weight-bold mb-2">Dostlarınız İçin En İyisi</h1>
    <p class="mb-4">Akvaryumdan evcil hayvan malzemelerine binlerce ürün.</p>
    
    <div class="container">
        <a href="/" class="hero-category-link {{ !request('category') ? 'active' : '' }}">Tümü</a>
        @if(isset($categories))
            @foreach($categories as $category)
                <a href="/?category={{$category->id}}" class="hero-category-link {{ request('category') == $category->id ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        @endif
    </div>
</div>

<div class="container">

    @if(request()->has('category'))
        <h3 class="mb-4 font-weight-bold text-primary">✨ Bu Kategorinin Yıldızları</h3>
        <div class="row mb-5">
            @foreach($products->take(2) as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card product-card h-100 shadow-sm border-danger position-relative">
                    <span class="badge badge-danger position-absolute" style="top:10px; left:10px; font-size:0.8rem;">🔥 Fırsat</span>
                    <img src="{{ asset($product->image) }}" class="card-img-top">
                    <div class="card-body text-center p-2">
                        <h6 class="font-weight-bold">{{ $product->title }}</h6>
                        <p class="price-text">{{ number_format($product->price, 2) }} ₺</p>
                        
                        <form action="{{ route('favorites.toggle', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger btn-block mb-2">
                                {{ in_array($product->id, $userFavorites) ? '❤️ Favorilerde' : '🤍 Favoriye Ekle' }}
                            </button>
                        </form>
                        
                        <form action="/cart/add/{{$product->id}}" method="GET" class="mt-2">
                            <div class="d-flex">
                                <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm text-center mr-2 shadow-sm" style="width: 60px; border-radius: 20px;">
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill w-100 shadow-sm">Sepete Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            @foreach($products->slice(2, 2) as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card product-card h-100 shadow-sm border-success position-relative">
                    <span class="badge badge-success position-absolute" style="top:10px; left:10px; font-size:0.8rem;">⭐ Çok Satan</span>
                    <img src="{{ asset($product->image) }}" class="card-img-top">
                    <div class="card-body text-center p-2">
                        <h6 class="font-weight-bold">{{ $product->title }}</h6>
                        <p class="price-text">{{ number_format($product->price, 2) }} ₺</p>

                        <form action="{{ route('favorites.toggle', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success btn-block mb-2">
                                {{ in_array($product->id, $userFavorites) ? '❤️ Favorilerde' : '🤍 Favoriye Ekle' }}
                            </button>
                        </form>

                        <form action="/cart/add/{{$product->id}}" method="GET" class="mt-2">
                            <div class="d-flex">
                                <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm text-center mr-2 shadow-sm" style="width: 60px; border-radius: 20px;">
                                <button type="submit" class="btn btn-sm btn-outline-success rounded-pill w-100 shadow-sm">Sepete Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <h3 class="mb-4 font-weight-bold">📦 Bu Kategorideki Tüm Ürünler</h3>
        <div class="row">
            @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card product-card h-100 shadow-sm">
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->title }}">
                    <div class="card-body text-center">
                        <h5 class="font-weight-bold">{{ $product->title }}</h5>
                        <p class="price-text">{{ number_format($product->price, 2) }} ₺</p>

                        <form action="{{ route('favorites.toggle', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary btn-block mb-2">
                                {{ in_array($product->id, $userFavorites) ? '❤️ Favorilerde' : '🤍 Favoriye Ekle' }}
                            </button>
                        </form>

                        <form action="/cart/add/{{$product->id}}" method="GET" class="mt-3">
                            <div class="d-flex">
                                <input type="number" name="quantity" value="1" min="1" class="form-control text-center mr-2 shadow-sm" style="width: 70px; border-radius: 20px;">
                                <button type="submit" class="btn btn-primary rounded-pill w-100 shadow-sm">Sepete Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12 text-center py-5"><p>Bu kategoride henüz ürün bulunmuyor.</p></div>
            @endforelse
        </div>

    @else
        <h3 class="mb-4 font-weight-bold text-danger">🔥 Fırsat Ürünleri</h3>
        <div id="firsatCarousel" class="carousel slide mb-5" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        @foreach($products->take(4) as $product)
                        <div class="col-md-3">
                            <div class="card product-card h-100 shadow-sm">
                                <img src="{{ asset($product->image) }}" class="card-img-top">
                                <div class="card-body text-center p-2">
                                    <h6 class="font-weight-bold">{{ $product->title }}</h6>
                                    <p class="price-text">{{ number_format($product->price, 2) }} ₺</p>
                                    
                                    <form action="{{ route('favorites.toggle', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-block mb-2">
                                            {{ in_array($product->id, $userFavorites) ? '❤️' : '🤍' }}
                                        </button>
                                    </form>

                                    <form action="/cart/add/{{$product->id}}" method="GET" class="mt-2">
                                        <div class="d-flex">
                                            <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm text-center mr-2 shadow-sm" style="width: 60px; border-radius: 20px;">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill w-100 shadow-sm">Sepete Ekle</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mb-4 font-weight-bold text-success">⭐ Çok Satanlar</h3>
        <div class="row mb-5">
            @foreach($products->take(4) as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card product-card h-100 shadow-sm border-success">
                    <img src="{{ asset($product->image) }}" class="card-img-top">
                    <div class="card-body text-center p-2">
                        <h6 class="font-weight-bold">{{ $product->title }}</h6>
                        <p class="price-text">{{ number_format($product->price, 2) }} ₺</p>

                        <form action="{{ route('favorites.toggle', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success btn-block mb-2">
                                {{ in_array($product->id, $userFavorites) ? '❤️' : '🤍' }}
                            </button>
                        </form>

                        <form action="/cart/add/{{$product->id}}" method="GET" class="mt-2">
                            <div class="d-flex">
                                <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm text-center mr-2 shadow-sm" style="width: 60px; border-radius: 20px;">
                                <button type="submit" class="btn btn-sm btn-outline-success rounded-pill w-100 shadow-sm">Sepete Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <h3 class="mb-4 font-weight-bold">Tüm Ürünler</h3>
        <div class="row">
            @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card product-card h-100 shadow-sm">
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->title }}">
                    <div class="card-body text-center">
                        <h5 class="font-weight-bold">{{ $product->title }}</h5>
                        <p class="price-text">{{ number_format($product->price, 2) }} ₺</p>

                        <form action="{{ route('favorites.toggle', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary btn-block mb-2">
                                {{ in_array($product->id, $userFavorites) ? '❤️' : '🤍' }}
                            </button>
                        </form>

                        <form action="/cart/add/{{$product->id}}" method="GET" class="mt-3">
                            <div class="d-flex">
                                <input type="number" name="quantity" value="1" min="1" class="form-control text-center mr-2 shadow-sm" style="width: 70px; border-radius: 20px;">
                                <button type="submit" class="btn btn-primary rounded-pill w-100 shadow-sm">Sepete Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12 text-center py-5"><p>Ürün bulunmuyor.</p></div>
            @endforelse
        </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>