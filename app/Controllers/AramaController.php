<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Musteri;
use \App\User;
class AramaController extends Controller
{
    public function aramaSonuclari(Request $request)
    { 
        $bulunanMusteriler = Musteri::where('isim', 'LIKE', '%' . $request->aramaText . '%')
        ->orWhere('sehir','LIKE','%' . $request->aramaText . '%')
        ->orWhere('sektor','LIKE','%' . $request->aramaText . '%')
        ->paginate(5);
        $request->aramaText;
        return view('arama.arama', compact('bulunanMusteriler'));
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