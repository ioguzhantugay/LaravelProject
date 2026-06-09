<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kategori Yönetimi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">
    <div class="container">
        <h2>Kategori Yönetimi</h2>
        
        <form action="/admin/categories" method="POST" class="mb-4 bg-white p-3 shadow-sm rounded">
            @csrf
            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="Yeni kategori adı (Örn: Bitkiler)" required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Ekle</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered bg-white">
            <thead class="thead-dark">
                <tr>
                    <th>Kategori Adı</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <form action="/admin/categories/{{ $category->id }}" method="POST" onsubmit="return confirm('Emin misin?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/admin/products" class="btn btn-secondary">Ürünlere Geri Dön</a>
    </div>
</body>
</html>