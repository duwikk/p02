@extends('admin')

@section('title', 'masterproject')
@section('content-title','Master Project')
@section('content')

<div class="row">
   <div class="col-lg-5">  
    <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-primary"><i class=""></i> Siswa</h6>
       <div class="card-body">
       <table class="table">
                <thead>
                    <tr>                 
                    <th scope="col">NISN</th>   
                    <th scope="col">NAMA</th>
                    <th scope="col">ACTION</th>
                    </tr>
                </thead>
                @foreach($data as $item)
                <tr>
                    <td> {{ $item->nisn }} </td> 
                    <td> {{ $item->nama }} </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-info btn-circle" onclick="show({{ $item->id }})"><i class="fas fa-folder-open"> </i></a>
                        <a href="{{ route('masterproject.tambah', $item->id) }}" class="btn btn-sm btn-success btn-circle"><i class="fas fa-plus"> </i></a>   
                    </td>
                </tr>
                @endforeach
                </table>
                <div class="card-footer d-flex justify-content-end">
                    {{ $data->links() }}  
                </div>
    </div>
    </div>
  </div>
</div>
    <!-- ketiga -->
    <div class="col-lg-7">
       <div class="card shadow mb-4">
         <div class="card-header">
         <h6 class="m-0 font-weight-bold text-primary"><i class=""></i> Project Siswa</h6>
         </div>
         <p class="text-center"></p>
          <div id="project" class="card-body">
            <h6>Pilih Siswa Terlebih Dahulu</h6>
        </div>
</div>   
</div>
</div>

<script>
function show(id){
  $.get('masterproject/'+id, function(data){
    $('#project').html(data);
  })
}
</script>

@endsection
