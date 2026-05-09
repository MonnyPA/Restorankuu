@extends('admin.layouts.master')
@section('title', 'Detail Pesanan')

@section('content')
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Detail Pesanan</h3>
                                {{-- <p class="text-subtitle text-muted">
                                    A sortable, searchable, paginated table
                                    without dependencies thanks to
                                    simple-datatables.
                                </p> --}}
                            </div>
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
                                            <a href="index.html">Dartar Pesanan</a>
                                        </li>
                                        <li
                                            class="breadcrumb-item active"
                                            aria-current="page"
                                        >
                                            Detail Pesanan
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4>Order Code : {{ $order->order_code }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <p>Nama Pelanggan</p>
                                        <p>Phone Pelanggan</p>
                                        <p>Methode Pembayaran</p>
                                        <p>Catatan</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>: <b>{{ $order->user->fullname }}</b></p>
                                        <p>: {{ $order->user->phone }}</p>
                                        <p>: {{ Str::ucfirst($order->payment_method) }}</p>
                                        <p>: {{ $order->note ?? 'Tidak ada Catatan dari Pelanggan' }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p>Nomor Meja</p>
                                        <p>Tanggal Pesanan</p>
                                        <p>Status Pembayaran</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>: {{ $order->table_number }}</p>
                                        <p>: {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y // H:s') }}</p>
                                        <p>:
                                            <span class="badge {{ $order->status == 'settlement' ? 'bg-success' : 'bg-danger' }}"> {{ Str::ucfirst($order->status) }}
                                                </span>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            @if(Auth::user()->role->role_name == 'admin' || Auth::user()->role->role_name == 'cashier' || Auth::user()->role->role_name == 'direktur' || Auth::user()->role->role_name == 'owner')
                                            @if ($order->status == 'pending' && $order->payment_method == 'tunai')
                                                <a href="{{ route('orders.settlement', $order->id) }}" class="btn btn-success"><i class="bi bi-check-circle"></i> Mark as Settlement</a>
                                            @endif
                                            @endif
                                        {{-- <button type="submit" class="btn btn-success">Update Role</button> --}}
                                            <a href="{{ route('orders.index') }}" class="btn btn-info ms-2"><i class="bi bi-arrow-left"></i> Kembali</a>
                                        </div>
                                </div>

                            </div>
                        </div>
                    </section>

                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Menu yang dipesan</h3>
                            </div>
                            <div class="card-body">


                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Gambar <br>Makanan</th>
                                            <th class="text-center">Nama Menu</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Harga Satuan</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Pajak</th>
                                            <th class="text-center">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderItems as $menu)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $menu->item->category->cat_name ?? '-' }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('img_item_upload/' . $menu->item->img) }}" alt="{{ $menu->item->name }}" class="img-thumbnail mb-2" style="width: 60px; height: 60px;" onerror="this.onerror=null;this.src='{{ $menu->item->img }}';">
                                            </td>
                                            <td class="text-center">{{ $menu->item->name }}</td>
                                            <td class="text-center">{{ $menu->quantity }}</td>
                                            <td class="text-center">{{ 'Rp. '. number_format($menu->item->price), 0, ',','.' }}</td>
                                            <td class="text-center">{{ 'Rp. '. number_format($menu->price), 0, ',','.' }}</td>
                                            <td class="text-center">{{ 'Rp. '. number_format($menu->tax), 0, ',','.' }}</td>
                                            <td class="text-center">{{ 'Rp. '. number_format($menu->total_price), 0, ',','.' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tr>
                                        <th colspan="8" class="text-end">Grand Total </th>
                                        <th>{{ 'Rp. '. number_format($order->grand_total, 0,',','.') }}</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
@endsection

