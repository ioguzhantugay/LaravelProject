<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Akvaryum Ürünü Ekle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Yeni Akvaryum Ürünü Ekle</h4>
                </div>
                <div class="card-body">
                    <form action="/admin/products" method="POST" enctype="multipart/form-data">
                        @csrf 

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Ürün Adı</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Örn: Hemianthus callitrichoides" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Açıklama</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold">Fiyat (₺)</label>
                                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold">Stok Adedi</label>
                                <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Ürün Fotoğrafı</label>
                            <input type="file" name="image" class="form-control-file border p-2 w-100">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Durum</label>
                            <select name="status" class="form-control">
                                <option value="True">Aktif (Vitrinde Göster)</option>
                                <option value="False">Pasif (Gizle)</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-lg btn-block mt-4">Ürünü Kaydet</button>
                        <a href="/admin/products" class="btn btn-outline-secondary btn-block mt-2">Listeye Geri Dön</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>