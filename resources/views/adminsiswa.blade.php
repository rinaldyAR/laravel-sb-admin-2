@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Daftar Siswa') }}</h1>


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
        <form class="d-none d-sm-inline-block form-inline navbar-search mb-2" style="width: 100%">
            <div class="input-group">
                <input type="text" class="form-control border-0 small" placeholder="Nama siswa" aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
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
                <th scope="col">Email</th>
                <th scope="col">Level</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $i=>$sis)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$sis->name}} {{$sis->last_name}}</td>
                    <td>{{$sis->email}} </td>
                    <td>{{$sis->userlevel}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>

@endsection
