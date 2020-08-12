@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pembayaran Siswa') }}</h1>


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
        <form class="d-none d-sm-inline-block form-inline navbar-search mb-2" style="width: 100%" role="form" action="/carinama" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="namasiswa" id="namasiswa" class="form-control border-0 small" placeholder="Nama siswa" aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelas</th>
                <th scope="col">Batch</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $i=>$sis)
                @if($sis->is_paid == 0)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$sis->name}} {{$sis->last_name}}</td>
                    <td>{{$sis->classname}} level {{$sis->classlevel}}</td>
                    <td>{{$sis->batch_start_date}} - {{$sis->batch_end_date}}</td>
                    <td scope="row">
                        <button id="{{$sis->id}}" type="button" class="openmodalbayar btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                        Konfirmasi
                        </button>
                    </td>
                </tr>
                @else
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$sis->name}} {{$sis->last_name}}</td>
                    <td>{{$sis->classname}} level {{$sis->classlevel}}</td>
                    <td>{{$sis->batch_start_date}} - {{$sis->batch_end_date}}</td>
                    <td scope="row">
                        Sudah Bayar
                    </td>
                </tr>
                @endif

                @endforeach
            </tbody>
          </table>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body my-3">
                Apakah anda yakin untuk mengkonfirmasi pembayaran ini?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <a href="" id="formkonfirm" name = "formkonfirm" class="btn btn-sm  btn-primary">Konfirm</a>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('modalbayar')
<script>
    $(document).on("click", ".openmodalbayar", function () {
        $('#formkonfirm').attr('href', '/konfirm/' + $(this)[0]['id']);
    });
</script>
@endpush
