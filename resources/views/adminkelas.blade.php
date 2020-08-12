@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#tambahkelas">
    kelas baru
    </button>
    <h1 class="h3 mb-4 text-gray-800">{{ __('Manage Kelas') }}</h1>


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
            <a href="/detail/{{$class->id}}" style="text-decoration : none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Level {{$class->classlevel}}</div>
                                <div class="h5 mb-1 font-weight-bold text-gray-800">{{ucfirst($class->classname)}} </div>
                                <div class="h5 mb-0 text-gray-600">{{ucfirst($class->classdescription)}} </div>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>

        @endforeach
    </div>



  <!-- Modal -->
  <div class="modal fade" id="tambahkelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <form role="form" action="/kelas" method="POST">
                    @csrf
                        <div class="form-group">
                          <label for="nama">Nama Kelas</label>
                          <input type="text" class="form-control" id="name" name = "name" placeholder="Nama Kelas">
                        </div>
                        <div class="form-group">
                          <label for="description">Deskripsi Kelas</label>
                          <textarea class="form-control" id="description" name = "description" placeholder="Deskripsi Kelas" cols="20" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="level">Level Kelas</label>
                            <select class="form-control" name="level" id="level">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
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
