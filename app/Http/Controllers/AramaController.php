<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Musteri;
use App\Durum;
use \App\User;
class AramaController extends Controller
{ public function __construct()
{
$this->middleware('auth');
}
    public function aramaSonuclari(Request $request)
    { 
    $bulunanMusteriler = Musteri::where('isim', 'LIKE', '%' . $request->aramaText . '%')
    ->orWhere('sehir','LIKE','%' . $request->aramaText . '%')
    ->orWhere('sektor','LIKE','%' . $request->aramaText . '%')
    ->get();
    $aramaText = $request->aramaText;
    $durumlar = Durum::all()->sortBy('durum_sira');
    $users = User::all();

    return view('arama.arama', compact('durumlar','bulunanMusteriler','aramaText','users'));
    }
    public function filtrele(Request $request){
    $query = Musteri::query();
    $query = $query->where('isim', 'LIKE', '%' . $request->isim . '%');
    $query = $query->where('sehir', 'LIKE', '%' . $request->sehir . '%');
    $query = $query->where('sektor', 'LIKE', '%' . $request->sektor . '%');
    if($request->durum != 99){
      $query = $query->where('durum', $request->durum);
    }
    if($request->bakiye == 'artan'){
       $query =$query->orderBy('bakiye','asc');
    }
    if($request->bakiye == 'azalan'){
     $query = $query->orderBy('bakiye','desc');
    }
     if($request->sonTahsilat == 'artan'){
      $query = $query->orderBy('sonTahsilat','asc');
     }
     if($request->sonTahsilat == 'azalan'){
     $query =$query->orderBy('sonTahsilat','desc');
     }
     if($request->onemSirasi != 0){
     $query =$query->where('onemSirasi', $request->onemSirasi);
     }
     
     $bulunanMusteriler = $query->get();
    $aramaText = $request->aramaText; 
    $isim = $request->isim;
    $sehir = $request->sehir;
    $sektor = $request->sektor;
    $durum = $request->durum;
    $durumlar = Durum::all()->sortBy('durum_sira');
    $users = User::all();
    return view('arama.arama', compact('durumlar','bulunanMusteriler','aramaText','sehir','sektor','durum','isim','users'));

    }

   
      public function kisiArama(Request $request)
      {
      if($request->aramaText != null || $request->aramaText != ''){
          $bulunanMusteriler = Musteri::where('isim', 'LIKE', '%' . $request->aramaText . '%')->get();
          $sonuc = [];
          foreach ($bulunanMusteriler as $key => $musteri) {
              array_push($sonuc, $musteri->isim);
          }
          return response()->json($sonuc);
          
        }
      }
}