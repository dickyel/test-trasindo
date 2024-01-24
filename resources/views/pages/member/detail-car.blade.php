@extends('layouts.member')

@section('title')
    Dashboard Produk Detail
@endsection

@section('content')
<div
  class="section-content section-dashboard-home"
  data-aos="fade-up"
>
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title"></h2>
        <p class="dashboard-subtitle">
          Detail Produk
        </p>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-12">
            @if($errors->any())
              <div class="alert-danger">
                  <ul>
                      @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>    
              </div>
            @endif
            <form action="" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="rental_id" value="{{ Auth::user()->rental->id }}">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Merek</label>
                        <input
                          type="text"
                          class="form-control"
                          id="merek"
                          name="merek"
                          value="{{ $car->merek }}"
                        />
                      </div>
                    </div>  
           
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Model</label>
                        <input
                          type="text"
                          class="form-control"
                          id="model"
                          name="model"
                          value="{{ $car->model }}"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Plat Nomor</label>
                        <input
                          type="text"
                          class="form-control"
                          id="plat_no"
                          name="plat_no"
                          value="{{ $car->plat_no}}"
                        />
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>tarif per hari</label>
                        <input
                          type="number"
                          class="form-control"
                          id="tarif_per_hari"
                          name="tarif_per_hari"
                          value="{{ $car->tarif_per_hari }}"
                        />
                      </div>
                    </div>
                 
                    <div class="col">
                      <button
                        type="submit"
                        class="btn btn-success btn-block px-5"
                      >
                        Simpan Sekarang
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                @foreach ($car->galleries as $gallery)
                  <div class="col-md-4">
                    <div class="gallery-container">
                      <img
                        src="{{ Storage::url($gallery->image ?? '') }}"
                        alt=""
                        class="w-100"
                      />
                      <a href="{{ route('car-form.gallery-delete', $gallery->id) }}" class="delete-gallery">
                        <img src="/images/icon-delete.svg" alt="" />
                      </a>
                    </div>
                  </div>
                @endforeach
                <div class="col-12">
                  <form action="{{ route('car-form.gallery-upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $car->id }}" name="car_id">

                    <input
                      type="file"
                      name="image"
                      id="file"
                      style="display: none;"
                      multiple
                      onchange="form.submit()"
                    />
                    <button
                      type="button"
                      class="btn btn-secondary btn-block mt-3"
                      onclick="thisFileUpload()"
                    >
                      Tambah Foto
                    </button>
                  </form>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script>
    function thisFileUpload() {
      document.getElementById("file").click();
    }
  </script>
  <script>
    CKEDITOR.replace("editor");
</script>
@endpush