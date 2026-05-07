@extends('admin.layouts.master')
@section('title', 'Tambah Karyawan')

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
            Manajemen Karyawan
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Karyawan</li>
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
            <h3 class="card-title">Tambah Karyawan</h3>
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
              <form class="form" action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="username" class="form-label"
                        >Username</label>
                      <input
                        type="text"
                        id="username"
                        class="form-control"
                        placeholder="Masukan Username"
                        name="username"
                        required
                      />
                    </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="form-label"
                        >Email</label
                      >
                      <input
                        type="text"
                        id="email"
                        class="form-control"
                        placeholder="Masukan Email"
                        name="email"
                        required
                    />
                    </div>
                    <div class="form-group">
                    <label for="fullname" class="form-label"
                        >Fullname</label
                    >
                    <input
                        type="text"
                        id="fullname"
                        class="form-control"
                        placeholder="Masuka fullname"
                        name="fullname"
                        required
                    />
                    </div>
                    <div class="form-group">
                      <label for="phone" class="form-label"
                        >Phone</label
                      >
                      <input
                        type="text"
                        id="phone"
                        class="form-control"
                        placeholder="Masukan Phone"
                        name="phone"
                        required
                      />
                    </div>

                    <div class="form-group">
                    <label for="role_id" class="form-label"
                        >Jabatan</label
                    >
                    <div class="col-md-12 p-0">
                        <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Select Jabatan</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ $role->role_name }}
                                </option>
                            @endforeach
                            @error('role_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                      <label for="password" class="form-label"
                        >Password</label
                      >
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        placeholder="password"
                        name="password"
                        required
                      />
                      <small><a href="#" class="toggle-password" data-target="password">Lihat Password</a></small>
                    </div>


                    <div class="form-group">
                      <label for="password_confirmation" class="form-label"
                        >Konfirmasi Password</label
                      >
                      <input
                        type="password"
                        id="password_confirmation"
                        class="form-control"
                        placeholder="konfirmasi password"
                        name="password_confirmation"
                        required
                      />
                      <small><a href="#" class="toggle-password" data-target="password_confirmation">Lihat Password</a></small>
                    </div>

                </div>
                <div class="row">
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('users.index') }}" class="btn btn-danger ms-2">Cancel</a>
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

<script>
    document.querySelectorAll('.toggle-password').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);
            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                this.textContent = 'Sembunyikan Password';
            } else {
                targetInput.type = 'password';
                this.textContent = 'Lihat Password';
            }
        });
    });
</script>

@endsection
