<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // panggil model Prodi menggunakan eloquent
        $prodi = Prodi::all(); // printah SQL select * from prodi
        // dd($prodi); // dump and die
        return view('prodi.index')->with('prodi', $prodi); // selain compact, bisa menggunakan with()
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $fakultas = Fakultas::all();
        return view('prodi.create', compact('fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //cek apakah user memiliki izin untuk membuat prodi
        if ($request->user()->cannot('create', Prodi::class)) {
            abort(403);
        }

        // validasi input
        $input = $request->validate([
            'nama' => 'required|unique:prodi',
            'singkatan' => 'required|max:5',
            'kaprodi' => 'required',
            'sekretaris' => 'required',
            'fakultas_id' => 'required',
        ]);

        //simpan data ke tabel fakultas
        Prodi::create($input);

        //redirect ke route fakultas.index
        return redirect()->route('prodi.index')->with('success', 'Prodi Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        return view('prodi.show', compact('prodi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $prodi)
    {
        $prodi = Prodi::findOrFail($prodi);

        // cek apakah user memiliki izin untuk mengedit prodi
        if ($request->user()->cannot('update', $prodi)) {
            abort(403);
        }
        $fakultas = Fakultas::all();
        return view('prodi.edit', compact('prodi', 'fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $prodi)
    {
        $prodi = Prodi::findOrFail($prodi);

        // cek apakah user memiliki izin untuk mengupdate prodi
        if ($request->user()->cannot('update', $prodi)) {
            abort(403);
        }

        // validasi input
        $input = $request->validate([
            'nama' => 'required|unique:prodi',
            'singkatan' => 'required|max:5',
            'kaprodi' => 'required',
            'sekretaris' => 'required',
            'fakultas_id' => 'required',
        ]);

        //update data Prodi
        $prodi->update($input);

        //rederict ke route Prodi.index
        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Prodi $prodi)
    {
        // cek apakah user memiliki izin untuk menghapus prodi
        if ($request->user()->cannot('delete', $prodi)) {
            abort(403);
        }
        $prodi->delete(); //menghapus data prodi
        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus.');
    }
}
