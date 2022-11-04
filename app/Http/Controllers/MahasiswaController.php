<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(){
        return view('mahasiswa.index', [
            'mahasiswas' => Mahasiswa::all(),
            'title' => 'Mahasiswa'
        ]);
    }

    public function indexxx(){
        $endpoint = "http://localhost:8000/api/mahasiswa";
        $client = new Client();

        $request = $client->request('GET', $endpoint, [
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);
    }

    public function create(){
        return view('mahasiswa.create', [
            'prodis' => Prodi::all(),
            'title' => 'Mahasiswa'
        ]);
    }
    
    public function store(Request $request){
        $validateData  = $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|unique:mahasiswas|string',
            'prodi_id' => 'required'
        ]);
        Mahasiswa::create($validateData);
        
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }
    
    public function show(Mahasiswa $id){
        return view('mahasiswa.show', [
            'mahasiswa' => $id,
            'title' => 'Mahasiswa',
        ]);
    }

    public function edit(Mahasiswa $id){
        return view('mahasiswa.edit', [
            'title' => 'Mahasiswa',
            'mahasiswa' => $id,
            'prodis' => Prodi::all(),
        ]);
    }

    public function destroy($id){
        $mahasiswa = Mahasiswa::findOrfail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    public function update(Request $request, $id){
        $mahasiswa = Mahasiswa::findOrfail($id);
        $validateData  = $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|unique:mahasiswas|string',
            'prodi_id' => 'required'
        ]);
        $mahasiswa->update($validateData);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Diupdate');

    }
}
