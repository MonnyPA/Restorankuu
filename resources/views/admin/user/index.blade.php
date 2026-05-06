@extends('admin.layouts.master')
@section('title', 'Manajemen Karyawan & Pelanggan')

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
                                            <a href="index.html">Manajemen Karyawan & Pelanggan</a>
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
                                <h3 class="card-title">Manajemen Karyawan & Pelanggan</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    {{-- @if(in_array(session('role'), ['Ownner','Direktur'])) --}}
                                    <a href="" class="btn btn-primary mb-3 ms-auto">New Karyawan</a>
                                    {{-- @endif --}}
                                </div>
                                <table class="table table-striped" id="table1">
                                    <thead>
                                       <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Fullname</th>
                                            <th class="text-center">Phone</th>
                                            {{-- <th class="text-center">Description</th> --}}
                                            <th class="text-center">Role</th>
                                            {{-- @if(in_array(session('role'), ['Ownner','Direktur'])) --}}
                                            <th class="text-center">Action</th>
                                            {{-- @endif --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $user->fullname }}</td>
                                                <td class="text-center">{{ $user->phone }}</td>
                                                <td class="text-center">{{ Str::ucfirst($user->role->role_name) }}</td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>

                                                    <form action="" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Karyawan?')"><i class="bi bi-trash"></i> Delete</button>
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

