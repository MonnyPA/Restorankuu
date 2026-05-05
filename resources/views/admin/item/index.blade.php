@extends('admin.layouts.master')
@section('title', 'Kelola Menu')

@section('content')
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3></h3>
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
                                            <a href="index.html">Kelola Menu</a>
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
                                <h3 class="card-title">Kelola Menu</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    {{-- @if(in_array(session('role'), ['Ownner','Direktur'])) --}}
                                    <a href="{{ route('items.create') }}" class="btn btn-primary mb-3 ms-auto">New Menu</a>
                                    {{-- @endif --}}
                                </div>
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Type Menu</th>
                                            <th class="text-center">Nama Menu</th>
                                            {{-- <th class="text-center">Description</th> --}}
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Status</th>
                                            {{-- @if(in_array(session('role'), ['Ownner','Direktur'])) --}}
                                            <th class="text-center">Action</th>
                                            {{-- @endif --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <span class="badge {{
                                                        optional($item->category)->cat_name == 'Makanan' ? 'bg-warning' :
                                                        (optional($item->category)->cat_name == 'Minuman' ? 'bg-info' :
                                                        'bg-success')
                                                    }}">
                                                    {{ $item->category->cat_name }}
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $item->name }}</td>
                                            {{-- <td class="text-center">{{ $item->description }}</td> --}}
                                            <td class="text-center">{{ 'Rp. '. number_format($item->price), 0, ',','.' }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $item->is_active ? 'Active' : 'Non Active' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if ($item->is_active)
                                                    <a href="#" class="btn btn-info btn-sm">Mark as Non Active</a>
                                                @else
                                                    <a href="#" class="btn btn-success btn-sm">Mark as Active</a>
                                                @endif
                                                <a href="" class="btn btn-warning btn-sm">Edit</a>

                                                <form action="" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Menu?')">Delete</button>
                                                </form>

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

