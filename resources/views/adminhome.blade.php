@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800">{{ __('Kelas Aktif') }}</h1>

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

            <div class="col-xl-4 col-md-4 mb-4">
            <a href="/detailkelas/{{$class->id}}" style="text-decoration : none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{$class->batch_start_date}} - {{$class->batch_end_date}}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ucfirst($class->classname)}} </div>
                            <div class="text-xs text-gray-600 mb-1">Level {{$class->classlevel}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>

        @endforeach
    </div>

@endsection
