@extends('admin.layouts.master')
@section('title', 'Daftar Pesanan')

@section('content')
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav
                                    aria-label="breadcrumb"
                                    class="breadcrumb-header float-start float-lg-end"
                                >
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index.html">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="index.html">Daftar Pesanan Hari ini</a>
                                        </li>
                                        <li
                                            class="breadcrumb-item active"
                                            aria-current="page"
                                        >
                                            Index
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Pesanan</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Tanggal Order</th>
                                            <th class="text-center">Kode Order</th>
                                            <th class="text-center">Total Harga</th>
                                            <th class="text-center">Metode <br>Pembayaran</th>
                                            <th class="text-center">Status <br>Pembayaran</th>
                                            @if(Auth::user()->role->role_name == 'admin' || Auth::user()->role->role_name == 'cashier' || Auth::user()->role->role_name == 'direktur' || Auth::user()->role->role_name == 'owner')
                                            <th class="text-center">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('orders.show', $order->id) }}">{{ $order->order_code }}</a>
                                            </td>
                                            <td class="text-center">{{ 'Rp. '. number_format($order->grand_total), 0, ',','.' }}</td>
                                            <td class="text-center">{{ Str::ucfirst($order->payment_method) }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $order->status == 'settlement' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ Str::ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if(Auth::user()->role->role_name == 'admin' || Auth::user()->role->role_name == 'cashier' || Auth::user()->role->role_name == 'direktur' || Auth::user()->role->role_name == 'owner')
                                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-light-secondary btn-sm"><i class="bi bi-eye"></i> View</a>
                                                    @if ($order->status == 'pending' && $order->payment_method == 'tunai')
                                                        <a href="{{ route('orders.settlement', $order->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to Settlement this Order Code : {{ $order->order_code }}?')"><i class="i bi-check-circle"></i> Mark as Settlement</a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
@endsection

