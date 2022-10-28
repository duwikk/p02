@extends('admin')

@section('title','Master Kontak')
@section('content-title','Master Kontak')
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{ $message }}</strong>
</div>
@endif

<div class="row">
<div class="col-lg-12">  
 <div class="card shadow mb-4">
 <div class="card-header">
   <h6 class="m-0 font-weight-bold text-primary"><i class="  "></i>  Jenis Kontak</h6>
   @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{-- <div class="input-group mb-3 mt-3">
        <input type="text" class="form-control" id="jenis_kontak" name="jenis_kontak">
        <a class="btn btn-outline-secondary" href="{{ route('jkontak.store') }}">Tambah</a>
    </div> --}}
  
   {{-- <input type="text" width="100px"> --}}
   @if (auth()->user()->role==0)
   <a href="{{ route('jkontak.create') }}" class="btn btn-outline-success" style="margin-left: 850px">Tambah Jenis Kontak</a>
   @endif
 </div>
    <div class="card-body text-center">
    <table class="table">
             <thead>
                 <tr>                 
                 <th scope="col">ID</th>   
                 <th scope="col">JENIS KONTAK</th>
                 @if (auth()->user()->role==0)
                 <th scope="col">ACTION</th>
                 @endif
                 </tr>
             </thead>
             @foreach($data_jkontak as $j_kontak)
             <tr>
                 <td> {{ $j_kontak->id }} </td> 
                 <td> {{ $j_kontak->jenis_kontak }} </td>
                 @if (auth()->user()->role==0)
                 <td class="text-center">
                    <a href="{{ route('jkontak.edit', $j_kontak->id)  }}" class="btn btn-sm btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                    <a href="{{ route('jkontak.hapus', $j_kontak->id)  }}" class="btn btn-sm btn-danger btn-circle"><i class="fas fa-trash"></i></a>
                 </td>
                 @endif
             </tr>
             @endforeach
    </table>
             <div class="card-footer d-flex justify-content-end">
                 {{ $data_jkontak->links() }}  
             </div>
    </div>
 
</div>
</div>
</div>

<div class="row">
  <div class="col-lg-5">
      <div class="card shadow mb-4">
          <div class="card-header py-3" style="background: pink;">
          <h6 class="m-0 font-weight-bold text-dark"><b>Data Siswa</b></h6>
          </div>
          <div class="card-body">
              <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Nisn</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($data as $item)    
                        <tr>
                          <td>{{ $item -> nisn }}</td>
                          <td>{{ $item -> nama }}</td>
                          <td>
                               <a class="btn btn-info" onclick="show({{ $item->id }})" ><i class="fas fa-folder-open"></i></a>
                               <a href="{{ url('mastercontact/create', $item->id)}}" class="btn btn-success"><i class="fas fa-plus"></i></a>
                          </td>
                        </tr>
                        @endforeach
                  </tbody>
                </table>
                <div class="card-footer d-flex justify-content-end">
                  {{ $data->links() }}
                </div>
          </div>
      </div>
  </div>
  {{-- info bary --}}
  <div class="col-lg-7">
      <div class="card shadow mb-4">
          <div class="card-header" style="background: pink;">
              <h6 class="m-0 font-weight-bold text-dark"><b>Contact Siswa</b></h6>
          </div>
          <div class="card-body" id="kontak">
            <h6 class="text-center" >Tidak ada data yang dipilih</h6>
          </div>
      </div>
  </div>
</div>

<script>
  function show(id){
    $.get('mastercontact/'+id, function(data){
      $('#kontak').html(data);
    });
  }
</script>



@endsection