@extends('admin.layouts.master')
@section('title', 'Kelola Menu')

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
              Kelola Menu
            </li>
            <li class="breadcrumb-item active" aria-current="page">Update Menu</li>
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
            <h3 class="card-title">Update Menu</h3>
          </div>
          <div class="card-content">
            <div class="card-body">
              <form class="form" action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <label for="name" class="form-label"
                        >Menu Name</label
                      >
                      <input
                        type="text"
                        id="name"
                        class="form-control"
                        placeholder="Menu Name"
                        name="name"
                        value="{{ old('name', $item->name) }}"
                        required
                      />
                    </div>
                    <div class="form-group">
                      <label for="category_id" class="form-label"
                        >Category</label
                      >
                      <div class="col-md-9 p-0">
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="" disabled>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $item->category_id == $category->id ? 'selected' : '' }}
                                    >
                                    {{ $category->cat_name }}
                                </option>
                            @endforeach
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                      <label for="img" class="form-label">Gambar Menu</label>
                      @if ($item->img)
                        <div class="mt-2 mb-2">
                            <img src="{{ asset('img_item_upload/' . $item->img) }}" alt="{{ $item->name }}" class="img-thumbnail mb-2" style="width: 100px; height: 100px;" onerror="this.onerror=null;this.src='{{ $item->img }}';">
                        </div>
                      @endif

                        <input
                        type="file"
                        id="img"
                        class="form-control"
                        placeholder="Inset Gambar Menu"
                        name="img"
                        value="{{ asset('img_item_upload/' . $item->img) }}"
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
                        placeholder="Input Description"
                        name="description"
                        value="{{ old('description', $item->description) }}"
                        required
                      />
                    </div>
                    <div class="form-group">
                      <label for="price" class="form-label"
                        >Price</label
                      >
                      <input
                        type="text"
                        id="price"
                        class="form-control"
                        placeholder="Input Price"
                        name="price"
                        value="{{ old('price', $item->price) }}"
                        required
                      />
                    </div>
                    <div class="form-group">
                      <label for="is_active" class="form-label"
                        >Status</label
                      >
                      <div class="form-check form-switch">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" class="form-check-input" id="flexSwicthCheckChecked" name="is_active" value="1" {{ $item->is_active == 1 ? 'checked' : '' }}>
                        <label for="flexSwicthCheckChecked">Aktif/Tidak Aktif</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('items.index') }}" class="btn btn-danger ms-2">Cancel</a>
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
