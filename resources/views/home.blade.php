@extends('layouts.user')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Kelas Anda') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        @foreach ($widget['classes'] as $class)
            <!-- Earnings (Monthly) Card Example -->
            @if ($class->is_paid == 1)
                <div class="col-xl-4 col-md-4 mb-4">

                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{$class->batch_start_date}} - {{$class->batch_end_date}} </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ucfirst($class->classname)}} Level {{$class->classlevel}}</div>
                                    </div>
                                </div>
                                <a href="/detail/{{$class->class_id}}" class="btn btn-primary btn-sm">
                                    akses kelas
                                </a>
                            </div>
                        </div>
                </div>
            @else
                <div class="col-xl-4 col-md-4 mb-4">
                    <a sstyle="text-decoration : none">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{$class->batch_start_date}} - {{$class->batch_end_date}} </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ucfirst($class->classname)}} Level {{$class->classlevel}}</div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalbayar">
                                    Bayar
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
            @endif


        @endforeach
    </div>
    <div class="modal fade" id="modalbayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div style="max-width: 600px !important" class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body my-3 mx-2">
                Lakukan pembayaran untuk kelas ini seharga Rp. 300.000.<br>
                Pembayaran dapat dilakukan dengan transfer ke rekening<br>
                BCA 133223234234 cabang pusat atas nama Pemilik Akun.<br> <br>
                Konfirmasi bukti pembayaran melalui: <br>
                Email: sdasdfadf <br>
                WA: sdasdfadf <br>
                IG: sdfasdfdad <br>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
@endsection
