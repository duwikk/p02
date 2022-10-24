@extends('admin')

@section('title', 'editsiswa')
@section('content-title','Edit Siswa')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
            @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $item)
                                <li>{{$item}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" enctype="multipart/form-data" action="{{ route('mastersiswa.update',  $siswa->id ) }}">
                @csrf
                @method('put')
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name='nama' value="{{ $siswa->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="nisn">Nisn</label>
                        <input type="text" class="form-control" id="nisn" name='nisn' value="{{ $siswa->nisn }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name='alamat' value="{{ $siswa->alamat }}">
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-select form-control" name="jk" id="jk">
                            <option value="lakilaki"@if($siswa->jk == 'lakilaki')selected @endif> Laki-Laki </option>
                            <option value="perempuan"@if($siswa->jk == 'perempuan')selected @endif> Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto Siswa</label>
                        <input type="file" class="form-control-file" id="foto" name="foto">
                        <img src="{{ asset('/template/img/'.$siswa->foto) }}" width="300" class="img-thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea class="form-control" id="about" name="about">{{ $siswa->about }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Update">
                        <!-- <a href="submit" class="btn btn-success">Update</a> -->
                        <a href="{{ route('mastersiswa.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

