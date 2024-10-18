<?php

namespace App\Http\Controllers;
use App\Models\TugasUmum;
use Illuminate\Http\Request;

class TugasUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
    $tugasumum = TugasUmum::where('namatugas', 'LIKE', '%'.$request->cari.'%')->simplePaginate(5)->appends($request->all());
    return view('pages.tugas_umum', compact('tugasumum'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tugasumum.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:100',
            'deadline' => 'required',
            'rombel' => 'required',
            'namatugas' => 'required'
        ], [
            'name.required' => 'Nama harus di isi!',
            'name.max' => 'Nama siswa maksimal 100 karakter',
            'deadline.required' => 'tanggal jam',
            'rombel.required' => 'Bagian harus di isi',
            'namatugas.required' => 'Bagian harus di isi',
        ]);

        TugasUmum::create($request->all());


        return redirect()->route('tugas_umum.tugas')->with('success', 'Berhasil Menambah Data siswa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $tugasumum = TugasUmum::find($id);
        return view('tugasumum.edit', compact('tugasumum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|max:100',
            'rombel' => 'required',
            'deadline' => 'required',
            'namatugas' => 'required',
        ]);

        $tugasumum= TugasUmum::find($id);

        $tugasumum->update([
            'name' => $request->name,
            'rombel' => $request->rombel,
            'deadline' => $request->deadline,
            'namatugas' => $request->namatugas
        ]);

        return redirect()->route('tugas_umum.tugas')->with('success', 'Berhasil Mengubah Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        TugasUmum::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
