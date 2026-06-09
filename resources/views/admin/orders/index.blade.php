@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Gelen Siparişler</h3>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card p-4 shadow-sm">
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>Sipariş ID</th>
                <th>Müşteri</th>
                <th>Tutar</th>
                <th>Yöntem</th>
                <th>Tarih</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->name }} {{ $order->surname }}</td>
                <td>{{ number_format($order->total_amount, 2) }} ₺</td>
                <td>
                    <span class="badge badge-{{ $order->payment_method == 'kart' ? 'primary' : 'success' }}">
                        {{ ucfirst($order->payment_method) }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">Detay</a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu siparişi silmek istediğinizden emin misiniz?');">
                        @csrf 
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Sil</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection