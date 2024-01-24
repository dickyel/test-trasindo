@extends('layouts.app')

@section('title')
    Swa Mobile Detail Toko
@endsection

@section('content')
<!-- Page Content -->
<div class="page-content page-details">
  <section
    class="store-breadcrumbs"
    data-aos="fade-down"
    data-aos-delay="100"
  >
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Beranda</a></li>
              <li class="breadcrumb-item active" aria-current="page">
                Detail Toko Sewa
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <section class="store-gallery" id="gallery">
    <div class="container">
      <div class="row">
        <img
          src=""
          alt=""
          class="col-md-6 "
        />
        <div class="col-md-3">
          <a
          class="btn btn-success nav-link px-4 text-white btn-block mb-3 "
          href=""
          >Lihat Alamat Di Maps</a>
          <a
            class="btn btn-success nav-link px-4 text-white btn-block mb-3"
            href=""
          >Hubungi Toko
        </a>
          
        </div>
        
        
      </div>
            
    </div>
  </section>

  <div class="store-details-container" data-aos="fade-up">
    <section class="store-heading">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h1></h1>
            
            <div class="owner">By. </div>
            
          
        </div>
      </div>
    </section>

    
    <section class="store-description">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-8">
            desc
          </div>
        </div>
      </div>
    </section>

    
  </div>

  <section class="store-new-products">
    <div class="container">
        <div class="row">
            <div class="col-12" data-aos="fade-up">
                <h5>Produk Toko</h5>
            </div>
        </div>
        <br>
        
        <div class="row">
        
            <div
              class="col-6 col-md-4 col-lg-3"
              data-aos="fade-up"
              data-aos-delay=" 100 "
            >
              <a href="" class="component-products d-block">
                <div class="products-thumbnail">
                  <div class="products-image" style="
                     
                    
                    ">
                  </div>
                </div>
                <br>
                
                <div class="products-text">
                 $product->name       
                </div>
                <div class="products-price">
                  $product->category->name
                </div>
                <div class="products-price">
                  $product->price
                </div>
                <div class="products-price">
                $product->day Hari
                </div>
              </a>
            </div>
          @empty
            <div
              class="col-12 text-center py-5"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              Tidak ada produk terbaru
            </div>
          @endforelse 
        </div>
        
           
    </div>
  </section>
  
</div>
@endsection

@push('addon-script')

  <script src="/vendor/vue/vue.js"></script>
    
@endpush
