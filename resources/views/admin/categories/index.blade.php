@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Kategori Yönetimi</h2>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="mb-4 bg-white p-3 shadow-sm rounded">
        @csrf
        <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Yeni kategori adı (Örn: Bitkiler)" required>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Ekle</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered bg-white shadow-sm">
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
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Emin misin?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection