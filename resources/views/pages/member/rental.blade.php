<!-- resources/views/pages/member/rental.blade.php -->

@extends('layouts.member')

@section('title')
    Swa Mobile Rental
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Rental</h2>
            <p class="dashboard-subtitle">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                Buat atau Update Toko Rental
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('member.rental.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <!-- Formulir Rental -->
                                <div class="row mb-2">
                                    <!-- Tambahkan input sesuai dengan atribut di model Rental -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label >Nama Toko</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="nama_toko"
                                                name="nama_toko"
                                                value="{{ old('nama_toko', optional(auth()->user()->rental)->nama_toko) }}"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label >Nomor Handphone Toko</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="nomor_toko"
                                                name="nomor_toko"
                                                value="{{ old('nomor_toko', optional(auth()->user()->rental)->nomor_toko) }}"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Alamat Toko</label>
                                            <textarea
                                                name="alamat"
                                                cols="30"
                                                rows="4"
                                                class="form-control"
                                            >{{ old('alamat', optional(auth()->user()->rental)->alamat) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">
                                            Simpan Sekarang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
