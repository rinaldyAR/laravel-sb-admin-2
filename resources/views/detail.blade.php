@extends('layouts.user')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{$data['class']->classname}}</h1>

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
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-materi" role="tab" aria-controls="nav-materi" aria-selected="false">Materi</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Tugas</a>
            </div>
          </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td style="width: 15%">Nama Kelas:</td>
                        <td style="width: 85%">{{$data['class']->classname}}</td>
                      </tr>
                      <tr>
                        <td>Deskripsi:</td>
                        <td>{{$data['class']->classdescription}}</td>
                      </tr>
                      <tr>
                        <td>Level Kelas:</td>
                        <td>{{$data['class']->classlevel}}</td>
                      </tr>
                      <tr>
                        <td>Tanggal Mulai Kelas:</td>
                        <td>{{$data['class']->batch_start_date}}</td>
                      </tr>
                      <tr>
                        <td>Tanggal Selesai Kelas:</td>
                        <td>{{$data['class']->batch_end_date}}</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
            <div style="padding: 1rem" class="tab-pane fade" id="nav-materi" role="tabpanel" aria-labelledby="nav-materi-tab">
                <div class="mb-2">
                </div>
                <table class="table">
                    <thead class="thead-light">
                      <tr >
                        <th scope="col">Materi</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Link Materi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['materi'] as $materi)
                        <tr>
                            <td>{{$materi->namamateri}}</td>
                            <td>{{$materi->deskripsimateri}}</td>
                            <td>{{$materi->linkmateri}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div style="padding: 1rem" class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="mb-2">
                    <form role="form" action="/jawaban" method="POST">
                        @csrf
                            <input type="hidden" class="form-control" id="batchclass" name = "batchclass" value="{{$data['class']->id}}">
                            <div class="form-group">
                              <select  class="browser-default custom-select" id="listtugas" name="listtugas">
                                <option disabled selected>Pilih Tugas</option>
                                @if ($data['assignment'] != null)
                                    @foreach ($data['assignment'] as $item)
                                        <option id="{{$item->id}}" name="{{$item->id}}" value="{{$item->id}}">{{$item->judulassignment}}</option>
                                    @endforeach
                                @endif
                            </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="linkjawaban" id="linkjawaban" class="form-control" placeholder="Link Tugas" >
                                    <div class="input-group-append">
                                      <button class="btn btn-outline-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                <table class="table">
                    <thead class="thead-light">
                      <tr >
                        <th scope="col">Tugas</th>
                        <th scope="col">Link Jawaban</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Review</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['answer'] as $answer)
                        <tr>
                            <td>{{$answer->judulassignment}}</td>
                            <td>{{$answer->linkjawaban}}<br><button class="btn btn-sm btn-warning">update</button></td>
                            <td>nilai</td>
                            <td>link review</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>

    </div>

@endsection

@push('dropdown')
<script>
</script>
@endpush
