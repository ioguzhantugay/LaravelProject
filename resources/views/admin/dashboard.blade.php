@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Yönetim Paneline Hoş Geldiniz</h2>
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
    </div>
</div>
@endsection