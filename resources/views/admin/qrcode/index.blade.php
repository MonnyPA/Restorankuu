@extends('admin.layouts.master')
@section('title', 'Generate QR Code')

@section('content')
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
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
                                            <a href="index.html">Generate QR Code</a>
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
                                <h3 class="card-title">QR Code</h5>
                            </div>
                            <div class="container">
                                <div class="row">
                                    @for ($i = 1; $i <= 10; $i++)
                                    <div class="col-md-3 text-center mb-4">
                                        <div class="card p-3">
                                            <h5>Meja {{ $i }}</h5>
                                            {!! QrCode::size(250)->generate(url('/menu?meja='.$i)) !!}
                                            <p class="mt-2">
                                                {{ url('/menu?meja='.$i) }}
                                            </p>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
@endsection

