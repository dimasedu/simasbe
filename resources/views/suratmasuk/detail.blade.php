@extends('app')
@section('content')
<div class="container p-3">
    <p class="fs-5 font-weight-bold">Detail Surat |  {{ $suratmasuk->no_surat }}</p>
    <div class="surat-resmi">
        <div class="row">
            <div class="col-md-6">
                <div class="surat-info">
                    <p><strong>Nomor Surat</strong></p>
                    <p><strong>Pengirim</strong></p>
                    <p><strong>Tanggal Surat</strong></p>
                    <p><strong>Tanggal Masuk</strong></p>
                    <p><strong>File Surat</strong></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="surat-data">
                    <p> : {{ $suratmasuk->no_surat }}</p>
                    <p> : {{ $suratmasuk->pengirim }}</p>
                    <p> : {{ $suratmasuk->tgl_surat }}</p>
                    <p> : {{ $suratmasuk->tgl_masuk }}</p>
                    <p> : <a href="{{ url('suratmasukfile/' . $suratmasuk->file_surat) }}" target="_blank">{{ $suratmasuk->file_surat }}</a></p>
                </div>
            </div>
        </div>
        <div class="file">
            <p><strong>Isi Ringkas:</strong></p>
            <p class="isi-ringkas">{{ $suratmasuk->ringkasan }}</p>
        </div>
    </div>
</div>
@endsection
