@extends('admin.layouts.master')
@section('title', 'Category')

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
              Kelola Category
            </li>
            <li class="breadcrumb-item active" aria-current="page">Update Category</li>
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
            <h3 class="card-title">Update Category</h3>
          </div>
          <div class="card-content">
            <div class="card-body">
              <form class="form" action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <label for="cat_name" class="form-label"
                        >Category Name</label
                      >
                      <input
                        type="text"
                        id="cat_name"
                        class="form-control"
                        placeholder="Category Name"
                        name="cat_name"
                        value="{{ old('cat_name', $category->cat_name) }}"
                        required
                      />
                        @error('cat_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                        value="{{ old('description', $category->description) }}"
                        required
                      />
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Update Category</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-danger ms-2">Cancel</a>
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
