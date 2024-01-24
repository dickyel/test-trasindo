@extends('layouts.auth')

@section('content')

<!-- Page Content -->
    <div class="page-content page-auth mt-5" id="register">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4">
              <h2>
                Silahkan Daftar
              </h2>
              <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input
                    v-model="name"  
                    id="name"
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autocomplete="name" 
                    autofocus>

                    @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input
                    v-model="email" 
                    id="email"
                    @change="checkEmail()" 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror"
                    :class="{ 'is-invalid' : this.email_unavailable }"
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autocomplete="email">

                    @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input 
                    id="password" 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    name="password" 
                    required 
                    autocomplete="new-password">

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Konfirmasi Password</label>
                  <input 
                    id="password-confirm" 
                    type="password"
                    name="password_confirmation"  
                    class="form-control @error('password_confirmation') is-invalid @enderror" 
                    required 
                    autocomplete="new-password">

                  @error('password_confirmation')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <input type="hidden" name="role" value="member"> <!-- Nilai role diset menjadi "member" secara default -->

                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon</label>
                    <input
                        v-model="nomor_telepon"
                        id="nomor_telepon"
                        type="text"
                        class="form-control @error('nomor_telepon') is-invalid @enderror"
                        name="nomor_telepon"
                        value="{{ old('nomor_telepon') }}"
                        required
                        autocomplete="nomor_telepon"
                    >

                    @error('nomor_telepon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nomor_sim">Nomor SIM</label>
                    <input
                        v-model="nomor_sim"
                        id="nomor_sim"
                        type="text"
                        class="form-control @error('nomor_sim') is-invalid @enderror"
                        name="nomor_sim"
                        value="{{ old('nomor_sim') }}"
                        required
                        autocomplete="nomor_sim"
                    >

                    @error('nomor_sim')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-success btn-block mt-4"
                :disabled="this.email_unavailable"
                >
                  Register Sekarang
                </button>
                <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                  Kembali Login
                </a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

@push('addon-script')
    <!-- <script src="/vendor/vue/vue.js"></script> -->
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
 
@endpush
