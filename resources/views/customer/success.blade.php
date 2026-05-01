@extends('customer.layouts.master')

@section('title', 'Pesanan Berhasil')

@section('content')
<div class="container-fluid py-5 d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 80px); margin-top: 80px;">
    <div class="receipt border p-4 bg-white shadow" style="width: margin-top: 5rem">
        <h5 class="text-center mb-2">Pesanan Berhasil dibuat!</h5>
        @if($order->payment_method == 'tunai' && $order->status == 'pending')
        <p class="text-center"><span class="badge bg-danger">Menunggu Pembayaran</span></p>
        @elseif ($order->payment_method == 'qris' && $order->status == 'pending')
        <p class="text-center"><span class="badge bg-info">Menunggu Konfirmasi Pembayaran</span></p>
        @else
        <p class="text-center"><span class="badge bg-success">Pembayaran Berhasil, Pesanan Diproses</span></p>
        @endif
        <h6 class="text-center">Nama Pemesan:  <br><span class="text-secondary">{{ $order->user->fullname }}</span></h6>
        <hr>
        <h4 class="fw-bold text-center">Kode Bayar: <br><span class="text-primary">{{ $order->order_code }}</span></h4>
        <h6 class="text-center">Nomor Meja:  <span>{{ $order->table_number }}</span></h6>
        <hr>
        <h5 class="text-center">Detail Pesanan</h5>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Menu</th>
                    <th class="text-center">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $orderItem)
                <tr>
                    <td>{{ $orderItem->quantity }}</td>
                    <td>{{ Str::limit($orderItem->item->name, 25) }}</td>
                    <td class="text-end">{{ 'Rp. '. number_format($orderItem->price, 0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="table table-borderless">
            <tbody>
                <tr class="text-end">
                    <td>Subtotal</td>
                    <td>{{ 'Rp. '. number_format($order->subtotal, 0,',','.') }}</td>
                </tr>
                <tr class="text-end">
                    <td>Pajak (10%)</td>
                    <td>{{ 'Rp. '. number_format($order->tax, 0,',','.') }}</td>
                </tr>
                <tr class="text-end">
                    <td>Grand Total</td>
                    <td class="fw-bold">{{ 'Rp. '. number_format($order->grand_total, 0,',','.') }}</td>
                </tr>
            </tbody>
        </table>
        @if($order->payment_method == "tunai")
            <p class="small text-center">Tunjukan Kode Bayar ini ke Kasir. <br>Jangan Lupa Senyum ya..!!!</p>
        @elseif($order->payment_method == "qris")
            <p class="small text-center">Terimakasih atas Pesanannya.</p>
        @endif
        <hr>
        <a href="{{ route('menu') }}" class="btn btn-primary w-100">Kembali ke Menu</a>
    </div>
</div>
@endsection
