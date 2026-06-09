@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Yönetim Paneline Hoş Geldiniz</h2>
        <a href="/" target="_blank" class="btn btn-dark shadow font-weight-bold px-4">
            🌍 Siteye Git
        </a>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Ürün Yönetimi</h5>
                    <p class="card-text">Ürünleri ekle, düzenle veya sil.</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light">Git</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Kategori Yönetimi</h5>
                    <p class="card-text">Kategorileri listele ve yönet.</p>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Git</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Sipariş Yönetimi</h5>
                    <p class="card-text">Gelen siparişleri görüntüle.</p>
                    <a href="{{ route('admin.orders') }}" class="btn btn-light">Git</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Mağazayı Görüntüle</h5>
                    <p class="card-text">Müşteri arayüzünü yeni sekmede aç.</p>
                    <a href="/" target="_blank" class="btn btn-light">🌍 Git</a>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection