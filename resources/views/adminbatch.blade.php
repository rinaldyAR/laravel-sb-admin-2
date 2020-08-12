@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <div class="btn btn-sm btn-primary float-right " data-toggle="modal" data-target="#tambahbatch">batch baru</div>
    <h1 class="h3 mb-4 text-gray-800">{{ __('Manage Batch') }}</h1>


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

    <div class="mb-3">

    </div>

    <div class="row">
        @foreach ($data['batches'] as $batch)
            <!-- Earnings (Monthly) Card Example -->

            <div class="col-xl-4 col-md-4 mb-4">
            <a href="" style="text-decoration : none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{$batch->batch_start_date}} - {{$batch->batch_end_date}}</div>
                                <div class="h5 mb-1 font-weight-bold text-gray-800">{{ucfirst($batch->batchname)}} </div>
                                <div class="h5 mb-0 text-gray-600">{{ucfirst($batch->batchdescription)}} </div>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>

        @endforeach
    </div>
    <div class="modal fade" id="tambahbatch" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Kelas Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <form role="form" action="/batch" method="POST">
                        @csrf
                            <div class="form-group">
                              <label for="nama">Nama Batch</label>
                              <input type="text" class="form-control" id="name" name = "name" placeholder="Nama Batch">
                            </div>
                            <div class="form-group">
                              <label for="description">Deskripsi Batch</label>
                              <textarea class="form-control" id="description" name = "description" placeholder="Deskripsi Batch" cols="20" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                    <label for="start">Tanggal Durasi Batch</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="input-sm form-control" name="start" id="start"/>
                                        <span class="input-group-addon mx-2">to</span>
                                        <input type="text" class="input-sm form-control" name="end" id="end"/>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="class">Kelas</label>
                                @foreach ($data['classes'] as $class)
                                    <div class="checkbox">
                                    <label><input name="kelas[]" type="checkbox" value="{{$class->id}}">&nbsp{{$class->classname}}</label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>

@endsection

@push('date')
<script type="text/javascript">
$('.input-daterange').datepicker({
    autoclose: true
});
</script>
@endpush
