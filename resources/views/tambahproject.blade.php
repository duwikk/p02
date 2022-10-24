@extends('admin')

@section('title', 'tambahproject')
@section('content-title','Tambah Project - '.$siswa->nama)
@section('content')

@if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $item)
                                <li>{{$item}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
<form method="post" enctype="multipart/form-data" action="{{ route('masterproject.store') }}">
@csrf
    <div class="form-group">
        <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
        <label for="nama">Nama Project</label>
        <input type="text" class="form-control" id="nama_project" name='nama_project'>
    </div>
    <div class="form-group">
        <label for="nama">Deskripsi Project</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="nama">Tanggal Project</label>
        <input type="date" class="form-control" id="tanggal_project" name='tanggal_project'>
    </div>
    <div class="form-group">
        <a href="{{ route('masterproject.index') }}" class="btn btn-danger">Batal</a>
        <input type="submit" class="btn btn-success" value="Simpan">
    </div>
</form>

@endsection