@extends('layouts.app') {{-- Eğer admin değil de genel layout kullanıyorsan --}}

@section('content')
<div class="container mt-5">
    <h2>👤 Profilim</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Kullanıcı Bilgileri</h5>
                <p><strong>İsim:</strong> {{ $user->name }}</p>
                <p><strong>E-posta:</strong> {{ $user->email }}</p>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-3">
                <h5>Sipariş Geçmişim</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tarih</th>
                            <th>Tutar</th>
                            <th>Durum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->created_at->format('d.m.Y') }}</td>
                            <td>{{ number_format($order->total_amount, 2) }} ₺</td>
                            <td>Tamamlandı</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection