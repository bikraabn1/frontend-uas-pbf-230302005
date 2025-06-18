<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PeminjamanController extends Controller
{
    public function index(){
        $response = Http::get("http://localhost:8080/peminjaman");
        $datas = $response->json();
        return view('peminjaman-view', compact('datas'));
    }

    public function store(Request $request){
        $response = Http::post("http://localhost:8080/peminjaman", $request);
        if($response->successful()){
            return redirect()->back()->with('success', 'Data Mahasiswa berhasil ditambahkan');
        }
        return redirect()->back()->with('error', 'Data mahasiswa gagal ditambahkan');
    }

    public function update(Request $request, string $id){
        $response = Http::put("http://localhost:8080/peminjaman/{$id}",);
        if($response->successful()){
            return redirect()->back()->with('success', 'Data Mahasiswa berhasil diupdate');
        }
        return redirect()->back()->with('error', 'Data mahasiswa gagal diupdate');
    }

    public function destroy(string $id){
        $response = Http::delete("http://localhost:8080/peminjaman/{$id}");
        if($response->successful()){
            return redirect()->back()->with('success', 'Data Mahasiswa berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Data mahasiswa gagal dihapus');
    }
}