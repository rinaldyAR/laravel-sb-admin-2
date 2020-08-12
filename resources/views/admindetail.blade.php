@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{$data['classes']->classname}}</h1>

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

    <div class="">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Detail</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Tugas</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-materi" role="tab" aria-controls="nav-profile" aria-selected="false">Materi</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-siswa" role="tab" aria-controls="nav-profile" aria-selected="false">Siswa</a>
            </div>
          </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td style="width: 15%">Nama Kelas:</td>
                        <td style="width: 85%">{{$data['classes']->classname}}</td>
                      </tr>
                      <tr>
                        <td>Deskripsi:</td>
                        <td>{{$data['classes']->classdescription}}</td>
                      </tr>
                      <tr>
                        <td>Level Kelas:</td>
                        <td>{{$data['classes']->classlevel}}</td>
                      </tr>
                      <tr>
                        <td>Tanggal Mulai Kelas:</td>
                        <td>{{$data['classes']->batch_start_date}}</td>
                      </tr>
                      <tr>
                        <td>Tanggal Selesai Kelas:</td>
                        <td>{{$data['classes']->batch_end_date}}</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
            <div style="padding: 1rem" class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="btn btn-sm btn-primary float-right mb-2" data-toggle="modal" data-target="#tambahtugas">tugas baru</div>
                <table class="table">
                    <thead class="thead-light">
                      <tr >
                        <th scope="col">Tugas</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['tugas'] as $tugas)
                        <tr>
                            <td>{{$tugas->judulassignment}}</td>
                            <td>{{$tugas->deskripsiassignment}}
                            </td>
                            <td><button class="btn btn-sm btn-warning">update</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div style="padding: 1rem" class="tab-pane fade" id="nav-materi" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="btn btn-sm btn-primary float-right mb-2" data-toggle="modal" data-target="#tambahmateri">materi baru</div>
                <table class="table">
                    <thead class="thead-light">
                      <tr >
                        <th scope="col">Materi</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Link</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['materi'] as $materi)
                        <tr>
                            <td>{{$materi->namamateri}}</td>
                            <td>{{$materi->deskripsimateri}}</td>
                            <td>{{$materi->linkmateri}}</td>
                            <td><button class="btn btn-sm btn-warning">update</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div style="padding: 1rem" class="tab-pane fade" id="nav-siswa" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table class="table">
                    <thead class="thead-light">
                      <tr >
                        <th scope="col">Nama</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['siswas'] as $siswa)
                        <tr>
                            <td>{{$siswa->name}} {{$siswa->last_name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>

    </div>

    <div class="modal fade" id="tambahtugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Tugas Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <form role="form" action="/tugas" method="POST">
                        @csrf
                    <input type="hidden" class="form-control" id="batchclass" name = "batchclass" value="{{$data['classes']->id}}">
                            <div class="form-group">
                              <label for="nama">Nama Tugas</label>
                              <input type="text" class="form-control" id="judulassignment" name = "judulassignment" placeholder="Nama Tugas">
                            </div>
                            <div class="form-group">
                              <label for="description">Deskripsi Tugas</label>
                              <textarea class="form-control" id="deskripsiassignment" name = "deskripsiassignment" placeholder="Deskripsi Tugas" cols="20" rows="5"></textarea>
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

      <div class="modal fade" id="tambahmateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Materi Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <form role="form" action="/materi" method="POST">
                        @csrf
                    <input type="hidden" class="form-control" id="batchclass" name = "batchclass" value="{{$data['classes']->id}}">
                            <div class="form-group">
                              <label for="nama">Nama Materi</label>
                              <input type="text" class="form-control" id="namamateri" name = "namamateri" placeholder="Nama Tugas">
                            </div>
                            <div class="form-group">
                              <label for="description">Deskripsi Materi</label>
                              <textarea class="form-control" id="deskripsimateri" name = "deskripsimateri" placeholder="Deskripsi Tugas" cols="20" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="nama">Link Materi</label>
                                <input type="text" class="form-control" id="linkmateri" name = "linkmateri" placeholder="Nama Tugas">
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

@push('dropdown')
<script>
$(document).ready(function(){
    $(".dropdown-menu a").click(function(){
        $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>' + '<div id="theid" style="display: none;"></div>');
        $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        //console.log($(this)[0]['id'])
        document.getElementById('theid').innerHTML = $(this)[0]['id'];
        console.log(document.getElementById('theid').innerHTML);
    });
});
</script>
@endpush
