@extends('admin.layouts.master')
@section('title', 'Show Menu')

@section('content')

<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <p class="text-subtitle text-muted">
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
              Kelola Menu
            </li>
            <li class="breadcrumb-item active" aria-current="page">View Menu</li>
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
            <h3 class="card-title">View Menu</h3>
          </div>
          <div class="card-content">
            <div class="card-body">
              <form class="form" action="#" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="name" class="form-label"
                        ><i>Menu Name :</i></label>
                      <p><b>{{ $item->name }}</b></p>
                    </div>
                    <div class="form-group">
                      <label for="name" class="form-label"
                        ><i>Desciption :</i></label>
                      <p><b>{{ $item->description }}</b></p>
                    </div>
                    <div class="form-group">
                      <label for="category_id" class="form-label"
                        ><i>Category :</i></label>
                      <p><b>{{ $item->category->cat_name }}</b></p>
                    </div>
                    <div class="form-group">
                      <label for="category_id" class="form-label"
                        ><i>Harga :</i></label>
                      <p><b>{{ 'Rp. '. number_format($item->price), 0, ',','.' }}</b></p>
                    </div>
                    <div class="form-group">
                      <label for="category_id" class="form-label"
                        ><i>Status :</i></label>
                      <p>
                        <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $item->is_active ? 'Active' : 'Non Active' }}
                        </span>
                      </p>
                    </div>

                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="description" class="form-label"
                        ><i>Gambar Menu :</i></label>
                      <br><img src="{{ asset('img_item_upload/' . $item->img) }}" alt="{{ $item->name }}" class="img-thumbnail mb-2" style="width: 300px; height: 300px;" onerror="this.onerror=null;this.src='{{ $item->img }}';">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 d-flex justify-content-end">
                    @if(Auth::user()->role->role_name == 'admin' || Auth::user()->role->role_name == 'direktur' || Auth::user()->role->role_name == 'owner' || Auth::user()->role->role_name == 'manager')
                    @if ($item->is_active)
                        <a href="{{ route('items.nonactive', $item->id) }}" class="btn btn-info ms-2">Non Active</a>
                    @else
                        <a href="{{ route('items.active', $item->id) }}" class="btn btn-success ms-2">Active</a>
                    @endif
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning ms-2">Edit</a>
                    @endif
                    <a href="{{ route('items.index') }}" class="btn btn-secondary ms-2">Kembali</a>
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
