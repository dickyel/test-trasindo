@extends('layouts.app')

@section('title')
    Swa Mobile Beranda
@endsection

@section('content')
    <div class="page-content page-home">
        <div class="container">
            <div class="row justify-content">
                <div class="col-md-6">
                    <form class="form" method="GET" action='/'>
                        <div class="form-group w-100 mb-3">
                            <input type="text" name="keyword" class="form-control w-75 d-inline" id="keyword"
                                   placeholder="Ketikkan sesuatu" value="{{ request('keyword') }}">
                            <button type="submit" class="btn btn-primary mb-1">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <section class="store-new-products">
            <div class="container">
                <div class="row">
                    <div class="col-6" data-aos="fade-up">
                        <h5>Mobil Terbaru</h5>
                    </div>
                </div>
                <div class="row">
                    @php $incrementCar = 0 @endphp
                    @if(!empty($cars) && $cars->count())
                        @foreach ($cars as $car)
                        <div class="modal fade" id="exampleModal{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pesan Mobil</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('peminjaman.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                                                <div class="form-group">
                                                    <label for="tanggal_mulai">Tanggal Mulai</label>
                                                    <input type="date" class="form-control tanggal_mulai" name="tanggal_mulai" id="tanggal_mulai_{{ $car->id }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_akhir">Tanggal Akhir</label>
                                                    <input type="date" class="form-control tanggal_akhir" name="tanggal_akhir" id="tanggal_akhir_{{ $car->id }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="total">Total Harga</label>
                                                    <input type="text" class="form-control total" name="total" id="total_{{ $car->id }}" readonly>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Pesan Mobil</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3" data-aos="fade-up"
                                 data-aos-delay="{{  $incrementCar += 20 }}">
                                <a href="#" class="component-products d-block modal-button"
                                   data-toggle="modal" data-target="#exampleModal{{ $car->id }}"
                                   data-tarif-per-hari="{{ $car->tarif_per_hari }}">
                                    <div class="products-thumbnail">
                                        <div class="products-image"
                                             style="
                                             @if($car->galleries->count() > 0 )
                                                 background-image: url('{{ Storage::url($car->galleries->first()->image) }}');
                                             @else
                                                 background-color: #eee;
                                             @endif
                                                 "></div>
                                    </div>

                                    <div class="products-text">
                                        {{ $car->merek }}
                                    </div>

                                    <div class="owner">
                                        {{ $car->model }}
                                    </div>

                                    <div class="products-price">
                                        {{ $car->tarif_per_hari }}
                                    </div>
                                    <div class="products-price">
                                        @if(auth()->check() && auth()->user()->hasBookedCar($car->id))
                                            <span class="badge badge-warning">Terbooking </span>
                                        @else
                                            {{ $car->status }}
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="20">
                            Tidak ada produk terbaru
                        </div>
                    @endif
                </div><br>

                <div class="col-md-12">
                    {{ $cars->links('vendor.pagination.custom')}}
                </div>

            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.modal-button').click(function () {
                var carTarifPerHari = $(this).data('tarif-per-hari') || 0;
                var carId = $(this).data('car-id');
                $('#exampleModal' + carId + ' .modal-dialog').data('tarif-per-hari', carTarifPerHari);
            });

            $('[id^="tanggal_mulai_"], [id^="tanggal_akhir_"]').change(function () {
                var carId = $(this).attr('id').split('_').pop();
                var startDate = new Date($('#tanggal_mulai_' + carId).val());
                var endDate = new Date($('#tanggal_akhir_' + carId).val());
                
                if (!isNaN(startDate) && !isNaN(endDate) && endDate >= startDate) {
                    var dateDifference = (endDate - startDate) / (1000 * 60 * 60 * 24);
                    var carTarifPerHari = $('#exampleModal' + carId + ' .modal-dialog').data('tarif-per-hari') || 0;
                    var total = dateDifference * carTarifPerHari;

                    // Update the total field in the modal
                    $('#total_' + carId).val(total.toFixed(2));
                } else {
                    // Handle invalid date range (optional)
                    // You may display an error message or clear the total field
                }
            });
        });
    </script>
@endpush



