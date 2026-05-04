@extends('admin.layouts.master')
@section('title', 'Kelola Pesanan')

@section('content')
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                {{-- <h3>Kelola Pesanan</h3> --}}
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
                                            <a href="index.html">Kelola Pesanan</a>
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
                                <h3 class="card-title">Kelola Pesanan</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Tanggal Order</th>
                                            <th class="text-center">Kode Order</th>
                                            <th class="text-center">Nama Pemesan</th>
                                            <th class="text-center">Total Harga</th>
                                            <th class="text-center">Metode <br>Pembayaran</th>
                                            <th class="text-center">Status <br>Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                                            <td class="text-center">{{ $order->order_code }}</td>
                                            <td class="text-center">{{ Str::ucfirst($order->user->fullname) }}</td>
                                            <td class="text-center">{{ 'Rp. '. number_format($order->grand_total), 0, ',','.' }}</td>
                                            <td class="text-center">{{ Str::ucfirst($order->payment_method) }}</td>
                                            <td class="text-center">{{ Str::ucfirst($order->status) }}</td>
                                            {{-- <td class="text-center">
                                                @if(in_array(session('role'), ['Ownner','Direktur']))
                                                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this department?')">Delete</button>
                                                </form>
                                                @endif
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
@endsection

