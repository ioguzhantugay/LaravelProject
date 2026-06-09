<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Akvaryum Ürün Envanteri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Akvaryum Ürün Envanteri</h2>
        <div>
            <a href="/" class="btn btn-outline-info">Siteye Dön</a>
            <a href="/admin/categories" class="btn btn-info">Kategori Yönetimi</a> <a href="/admin/products/create" class="btn btn-success">Yeni Ürün Ekle</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Ürün Adı</th>
                        <th>Kategori</th> <th>Fiyat</th>
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
                        <td class="align-middle">{{ $product->price }} ₺</td>
                        <td class="align-middle">{{ $product->quantity }}</td>
                        <td class="align-middle">
                            <div class="d-flex">
                                <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-warning btn-sm mr-2">Düzenle</a>
                                
                                <form action="/admin/products/{{ $product->id }}" method="POST" onsubmit="return confirm('Bu ürünü silmek istediğine emin misin?');">
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
</div>

</body>
</html>