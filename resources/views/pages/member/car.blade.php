@extends('layouts.member')

@section('title')
    Dashboard Produk
@endsection

@section('content')

    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Produk Saya</h2>
                <p class="dashboard-subtitle">
                    Atur Semuanya dan dapatkan cuan
                </p>
            </div>
            <div class="dashboard-content">

                @if(auth()->user()->rental) 
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('car-form.create') }}" class="btn btn-success">Tambah Produk Baru</a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 col-sm-8 col-md-4 col-lg-3">
                          
                            @foreach(auth()->user()->rental->cars as $car)
                                <a class="card card-dashboard-product d-block" href="{{ route('car-form.detail', $car->id) }}">
                                    <div class="card-body">
                                        <img src="" alt="" class="w-100 mb-2" />
                                        <div class="product-title">{{ $car->merek }}</div>
                                        <div class="product-category">{{ $car->model }}</div>
                                        <div class="product-category">{{ $car->plat_no }} </div>
                                        <div class="product-category">{{ $car->tarif_per_hari }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
               
                    <div class="row align-items-center row-login justify-content-center">
                        <div class="col-lg-6 text-center">
                            <br><br><br><br><br><br><br><br>
                            <h2>
                                Kamu belum buat toko dan <br>
                                buat dulu yuk
                            </h2>

                            <div>
                                <a class="btn btn-success w-50 mt-4" href="{{ route('rental.index') }}">
                                    Dashboard Buat Toko
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
