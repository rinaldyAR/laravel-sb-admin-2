@extends('layouts.user')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Kelas Baru') }}</h1>

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
        @foreach ($classes as $class)
            <!-- Earnings (Monthly) Card Example -->

            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{$class->batch_start_date}} - {{$class->batch_end_date}} </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ucfirst($class->classname)}} Level {{$class->classlevel}}</div>
                            </div>
                        </div>
                        <button id="{{$class->id}}" type="button" class="openkelas btn btn-primary btn-sm" data-toggle="modal" data-target="#modalkelas">
                            Daftar
                        </button>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
    <div class="modal fade" id="modalkelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body my-3">
                Apakah anda yakin untuk mendaftar ke kelas ini?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <a href="" id="formdaftar" name = "formdaftar" class="btn btn-sm  btn-primary">Konfirm</a>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('modalkelasbaru')
<script>
    $(document).on("click", ".openkelas", function () {
        $('#formdaftar').attr('href', '/daftar/' + $(this)[0]['id']);
    });
</script>
@endpush
