<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Düzenle: {{ $product->title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Düzenleniyor: {{ $product->title }}</h4>
                </div>
                <div class="card-body">
                    <form action="/admin/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Ürün Adı</label>
                            <input type="text" name="title" class="form-control" value="{{ $product->title }}" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Fiyat (₺)</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Stok Adedi</label>
                            <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Mevcut Resim:</label><br>
                            <img src="{{ asset($product->image) }}" class="img-thumbnail" width="150" alt="Ürün Resmi">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Yeni Resim Seç</label>
                            <input type="file" name="image" class="form-control-file border p-2 w-100">
                            <small class="text-muted">Resmi değiştirmek istemiyorsan boş bırak.</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">Değişiklikleri Kaydet</button>
                        <a href="/admin/products" class="btn btn-outline-secondary btn-block mt-2">İptal Et ve Listeye Dön</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>