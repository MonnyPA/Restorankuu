@extends('admin.layouts.master')
@section('title', 'Manajemen Karyawan')

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
                                            <a href="index.html">Manajemen Karyawan</a>
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
                                <h3 class="card-title">Manajemen Karyawan</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    {{-- @if(in_array(session('role'), ['Ownner','Direktur'])) --}}
                                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3 ms-auto">New Karyawan</a>
                                    {{-- @endif --}}
                                </div>
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert"">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="font-size: 0.7rem;"></button>
                                    </div>
                                @endif
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="">No</th>
                                            <th class="">Username</th>
                                            <th class="">Fullname</th>
                                            <th class="">Email</th>
                                            <th class="">Phone</th>
                                            {{-- <th class="">Description</th> --}}
                                            <th class="">Role</th>
                                            {{-- @if(in_array(session('role'), ['Ownner','Direktur'])) --}}
                                            <th class="text-center">Action</th>
                                            {{-- @endif --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="">{{ $loop->iteration }}</td>
                                                <td class="">{{ $user->username }}</td>
                                                <td class="">{{ $user->fullname }}</td>
                                                <td class="">{{ $user->email }}</td>
                                                <td class="">{{ $user->phone }}</td>
                                                <td class="">{{ Str::ucfirst($user->role->role_name) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>

                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Karyawan {{ $user->fullname }}?')"><i class="bi bi-trash"></i> Delete</button>
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

