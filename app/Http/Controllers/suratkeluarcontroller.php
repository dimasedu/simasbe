<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\suratkeluar;
use Illuminate\Http\Request;
use App\Imports\SuratmasukImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Mime\Part\File;

class SuratkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = suratkeluar::all();
        return view(suratkeluar.index', compact('query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(suratkeluar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'tglsurat' => 'required',
                'tglkeluar' => 'required',
                'nosurat' => 'required',
                'pengirim' => 'required',
                'isi' => 'required',
                'file' => 'required|mimes:pdf|max:10000',
            ],
            [
                'tglsurat.required' => 'Kolom Tanggal Surat tidak boleh kosong',
                'tglmasuk.required' => 'Kolom Tanggal Masuk tidak boleh kosong',
                'nosurat.required' => 'Kolom No. Surat tidak boleh kosong',
                'pengirim.required' => 'Kolom Pengirim tidak boleh kosong',
                'isi.required' => 'Kolom Isi Ringkas tidak boleh kosong',
                'file.required' => 'Silahkan pilih file surat',
                'file.mimes' => 'Tipe File harus PDF',
                'file.max' => 'Ukuran file tidak boleh dari 10 MB',
            ],
        );

        if ($request->hasFile('file')) {
            $fileSurat = $request->file('file');
            $newName = 'ulfa.moy' . date('Ymd') . '.' . rand() . '.' . $fileSurat->getClientOriginalExtension();
            $fileSurat->move('./suratmasukfile/', $newName);
        }

        $simpan = suratkeluar::create([
            'tgl_surat' => $request->tglsurat,
            'tgl_masuk' => $request->tglmasuk,
            'no_surat' => $request->nosurat,
            'pengirim' => $request->pengirim,
            'ringkasan' => $request->isi,
            'file_surat' => $newName,
        ]);

        $simpan->save();

        return redirect()
            ->route('suratmasuks.index')
            ->with('success', 'Data Surat Masuk sudah berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(suratkeluar suratkeluar)
    {
        return view(suratkeluar.detail', compact(suratkeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(suratkeluar suratkeluar)
    {
        return view(suratkeluar.edit', compact(suratkeluar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, suratkeluar suratkeluar)
    {
        $request->validate(
            [
                'tglsurat' => 'required',
                'tglmasuk' => 'required',
                'nosurat' => 'required',
                'pengirim' => 'required',
                'isi' => 'required',
                'file' => 'mimes:pdf|max:10000',
            ],
            [
                'tglsurat.required' => 'Kolom Tanggal Surat tidak boleh kosong',
                'tglmasuk.required' => 'Kolom Tanggal Masuk tidak boleh kosong',
                'nosurat.required' => 'Kolom No. Surat tidak boleh kosong',
                'pengirim.required' => 'Kolom Pengirim tidak boleh kosong',
                'isi.required' => 'Kolom Isi Ringkas tidak boleh kosong',
                'file.required' => 'Silahkan pilih file surat',
                'file.mimes' => 'Tipe File harus PDF',
                'file.max' => 'Ukuran file tidak boleh dari 10 MB',
            ],
        );

        $filesurat = $request->file('file');

        suratkeluar->no_surat = $request->nosurat;
        suratkeluar->tgl_surat = $request->tglsurat;
        suratkeluar->tgl_masuk = $request->tglmasuk;
        suratkeluar->pengirim = $request->pengirim;
        suratkeluar->ringkasan = $request->isi;

        if ($filesurat != '') {
            $new_name = 'ulfa.moy' . date('Ymd') . '.' . rand() . '.' . $filesurat->extension();
            $filesurat->move('./suratmasukfile', $new_name);
            // Hapus file lama jika ada
            $oldFilePath = './suratmasukfile/' . suratkeluar->file_surat;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            suratkeluar->file_surat = $new_name;
        }

        suratkeluar->save();

        return redirect()
            ->route('suratmasuks.index')
            ->with('success', 'Ubah Surat Masuk sudah berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(suratkeluar suratkeluar)
    {
        suratkeluar->delete();

        return redirect()
            ->route('suratmasuks.index')
            ->with('success', 'Data Surat Masuk sudah berhasil dihapus');
    }

    public function import()
    {
        return view(suratkeluar.import');
    }

    public function importproses(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        Excel::import(new SuratmasukImport(), $request->file('file'));

        return redirect()
            ->route('suratmasuks.index')
            ->with('success', 'Import data berhasil');
    }

    public function exportpdf()
    {
        $query = suratkeluar::all();

        $pdf = PDF::loadview(suratkeluar.suratmasuk_pdf', ['query' => $query]);
        return $pdf->download('data_suratmasuk.pdf');
    }
}
