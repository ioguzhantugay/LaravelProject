@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Akvaryum Ürün Envanteri</h2>
    <div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">Yeni Ürün Ekle</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Ürün Adı</th>
                    <th>Kategori</th> 
                    <th>Fiyat</th>
                    <th>Stok Adedi</th> 
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="align-middle">{{ $product->title }}</td>
                    <td class="align-middle">
                        {{ $product->category ? $product->category->name : 'Kategori Yok' }}
                    </td>
                    <td class="align-middle">{{ number_format($product->price, 2) }} ₺</td>
                    <td class="align-middle">{{ $product->stock }}</td>
                    <td class="align-middle">
                        <div class="d-flex">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm mr-2">Düzenle</a>
                            
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bu ürünü silmek istediğine emin misin?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection