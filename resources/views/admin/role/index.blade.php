@extends('admin.layouts.master')
@section('title', 'Manajemen Role')

@section('content')
            <div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kelola Role</h3>
                {{-- <p class="text-subtitle text-muted">Manage Department Information.</p> --}}
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="#">Kelola Role</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            {{-- <div class="card-header">
                <h5 class="card-title">
                    Menu
                </h5>
            </div> --}}
            <div class="card-body">
                <div class="d-flex">
                    {{-- @if(in_array(session('role'), ['Ownner','Direktur'])) --}}
                    <a href="" class="btn btn-primary mb-3 ms-auto">New Role</a>
                    {{-- @endif --}}
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table
                    class="display table table-striped table-hover "
                    id="">

                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Role Name</th>
                            <th class="text-center">Description</th>
                            {{-- @if(in_array(session('role'), ['Ownner','Direktur'])) --}}
                            <th class="text-center">Action</th>
                            {{-- @endif --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ Str::ucfirst($role->role_name) }}</td>
                                <td class="text-center">{{ $role->description }}</td>
                                <td class="text-center">
                                    <a href="" class="btn btn-warning btn-sm">Edit</a>

                                    <form action="" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Role?')">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td>Graiden</td>
                            <td>vehicula.aliquet@semconsequat.co.uk</td>
                            <td>076 4820 8838</td>
                            <td>Offenburg</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
