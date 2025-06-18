<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

class BukuController extends Controller
{
    public function index(){
        $response = Http::get("http://localhost:8080/buku");
        $datas = $response->json();
        return view('buku-view', compact('datas'));
    }

    public function store(Request $request){
        $response = Http::post("http://localhost:8080/buku", $request);
        if($response->successful()){
            return redirect()->back()->with('success', 'Data Mahasiswa berhasil ditambahkan');
        }
        return redirect()->back()->with('error', 'Data mahasiswa gagal ditambahkan');
    }

    public function update(Request $request, string $id){
        $response = Http::put("http://localhost:8080/buku/{$id}",$request->all());
        if($response->successful()){
            return redirect()->back()->with('success', 'Data Mahasiswa berhasil diupdate');
        }
        return redirect()->back()->with('error', 'Data mahasiswa gagal diupdate');
    }

    public function destroy(string $id){
        $response = Http::delete("http://localhost:8080/buku/{$id}");
        if($response->successful()){
            return redirect()->back()->with('success', 'Data Mahasiswa berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Data mahasiswa gagal dihapus');
    }

    public function downloadPDF()
    {
        $response = Http::get("http://localhost:8080/buku");
        $datas = $response->json();

        $pdf = Pdf::loadView('buku-pdf-view', ['datas' =>  $datas])
        ->setPaper('a4', 'portrait');

        return $pdf->download('buku.pdf');   
    }
}