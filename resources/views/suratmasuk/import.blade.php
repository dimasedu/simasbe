@extends('app')
@section('content')
<div class="px-4 py-5">
<div class="card">
<div class="card-header">
  <div class="card-title"><h4>Import Surat Masuk</h4></div>
</div>
<div class="card-body">
  
<form action="{{ url('suratmasukimportproses') }}" method="post" enctype="multipart/form-data">
  @csrf
  <p><b>Kolom bertanda <span class="text-danger">*)</span> tidak boleh kosong</b></p>
  
  <div class="row ">
      <div class="col">
        <label for="">File Surat <span class="text-danger">*)</span></label>
        <input type="file" name="file" class="form-control @if($errors->has('file')) is-invalid @endif" placeholder="Pilih File" value="{{old('file')}}">
        <small>Tipe File : XLS / XLXS</small>                  
          @if($errors->has('file'))
          <br>
          <small class="text-danger">
            {{$errors->first('file')}}
          </small>
          @endif
        
      </div>
  </div>

</div>
<div class="card-footer">
  <div class="my-2">
          <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Proses</button>
          <a href="{{route('suratmasuks.index')}}" class="btn btn-danger"><i class="fa fa-backward"></i> Kembali</a>
      </div>
  </form>
</div>
</div>    
</div>
@endsection