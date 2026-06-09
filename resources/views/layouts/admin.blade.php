<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Akvaryum Dünyası | Yönetim Paneli</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f7f6; }
        .sidebar { min-height: 100vh; background: #343a40; position: sticky; top: 0; }
        .sidebar a { color: white; display: block; padding: 15px; text-decoration: none; border-bottom: 1px solid #495057; }
        .sidebar a:hover { background: #495057; text-decoration: none; color: #fff; }
        .sidebar .btn-link { color: #dc3545; padding: 15px; text-decoration: none; width: 100%; text-align: left; border: none; background: none; }
        .sidebar .btn-link:hover { background: #495057; color: #ff6b6b; }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar col-md-2 p-0">
        <a href="{{ route('admin.dashboard') }}" style="text-decoration: none;">
            <h4 class="text-white p-3 mb-0">Admin Panel</h4>
        </a>
        <hr class="bg-light mt-0">
        
        <a href="{{ route('admin.dashboard') }}">Panel Anasayfa</a>
        <a href="{{ route('admin.products.index') }}">Ürünler</a>
        <a href="{{ route('admin.categories.index') }}">Kategoriler</a>
        <a href="{{ route('admin.orders') }}">Siparişler</a>
        
        <hr class="bg-light">
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link text-danger">Çıkış Yap</button>
        </form>
    </div>

    <div class="col-md-10 p-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @yield('content')
    </div>
</div>

</body>
</html>