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
        <h2 class="dashboard-title">Tambah Produk Baru</h2>
        <p class="dashboard-subtitle">
          Buat Produk Kamu
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
            <form action="{{ route('car-form.store') }}" method="post" enctype="multipart/form-data">
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
                        />
                      </div>
                    </div>
              
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Thumbnail</label>
                        <input
                          type="file"
                          class="form-control"
                          name="image"
                        />
                        <small class="text-muted">
                          Pilih Foto Thumbnail Utama Produk Kamu
                        </small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col">
                  <button
                    type="submit"
                    class="btn btn-success btn-block px-5"
                  >
                    Simpan Sekarang
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="/script/js/ckeditor/ckeditor.js"></script>
  
<script>
  CKEDITOR.replace("editor");
</script>
@endpush