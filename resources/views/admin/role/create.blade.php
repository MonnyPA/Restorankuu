@extends('admin.layouts.master')
@section('title', 'Tambah Role')

@section('content')

<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        {{-- <h3>Form Validation</h3> --}}
        <p class="text-subtitle text-muted">
          {{-- Complete the form with powerful validation library such as Parsley. --}}
        </p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav
          aria-label="breadcrumb"
          class="breadcrumb-header float-start float-lg-end"
        >
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              Manajemen Role
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Role</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <!-- // Basic multiple Column Form section start -->
  <section id="multiple-column-form">
    <div class="row match-height">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah Role</h3>
          </div>
          <div class="card-content">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-warning alert-dismissible fade show py-2 px-3 small" role="alert">
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="mb-0">Oops! Terjadi kesalahan</h5>
                        </div>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li class="small">{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
              <form class="form" action="{{ route('roles.store') }}" method="POST">
                @csrf

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <label for="role_name" class="form-label"
                        >Role Name</label
                      >
                      <input
                        type="text"
                        id="role_name"
                        class="form-control"
                        placeholder="Role Name"
                        name="role_name"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="description" class="form-label"
                        >Description</label
                      >
                      <input
                        type="text"
                        id="description"
                        class="form-control"
                        placeholder="Description"
                        name="description"
                        required
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-danger ms-2">Cancel</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- // Basic multiple Column Form section end -->
</div>

@endsection
