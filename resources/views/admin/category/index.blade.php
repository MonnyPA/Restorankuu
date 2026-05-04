@extends('admin.layouts.master')
@section('title', 'Category')

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
                                            <a href="index.html">Kelola Category</a>
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
                                <h3 class="card-title">Kelola Category</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    {{-- @if(in_array(session('role'), ['Ownner','Direktur'])) --}}
                                    <a href="" class="btn btn-primary mb-3 ms-auto">New Category</a>
                                    {{-- @endif --}}
                                </div>
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Category Name</th>
                                            <th class="text-center">Description</th>
                                            {{-- @if(in_array(session('role'), ['Ownner','Direktur'])) --}}
                                            <th class="text-center">Action</th>
                                            {{-- @endif --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ Str::ucfirst($category->cat_name) }}</td>
                                                <td class="text-center">{{ $category->description }}</td>
                                                <td class="text-center">
                                                    <a href="" class="btn btn-warning btn-sm">Edit</a>

                                                    <form action="" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Category?')">Delete</button>
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

