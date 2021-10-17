<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Musteri;
use \App\User;
use \App\Durum;
use \App\Muhasebe;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
class MuhasebeController extends Controller
{ public function __construct()
{
$this->middleware('auth');
}
     public function index(){
     $tumMusteriler= Musteri::orderBy('isim', 'ASC')->get();
     $enSon = Musteri::orderBy('updated_at', 'DESC')->get();
     $seciliDurum = 6;
     $users = \App\User::all();
     $durumlar = Durum::all()->sortBy('durum_sira');
     return view('muhasebe.index', compact('durumlar','tumMusteriler','enSon', 'seciliDurum','users'));
     }
     public function bakiyeleriIsle()
     {
        $tumMusteriler= Musteri::orderBy('isim', 'ASC')->get();
        foreach ($tumMusteriler as $key => $musteri) {
           $musteriMuhasebeKayitlari = Muhasebe::where('musteri_id',$musteri->id)->get();
           $musteriBakiye = 0;
           foreach ($musteriMuhasebeKayitlari as $key => $item) {
              if($item->BA == 'B'){
              $musteriBakiye -= $item->tutar;
              }
              if($item->BA == 'A'){
              $musteriBakiye += $item->tutar;
              }
              }
              Musteri::where('id',$musteri->id)->update(['bakiye' => $musteriBakiye]);
        }
        
    
        return redirect('/portfolyo');
     } 
     public function islemYap(Request $request)
     {
      
      $request->duzeltme = 'true';
      $muhasebeKaydi = Muhasebe::create($this->validatedData());


      $musteriMuhasebeKayitlari = Muhasebe::where('musteri_id',$request->musteri_id)->get();
      $musteriBakiye = 0;
      foreach ($musteriMuhasebeKayitlari as $key => $item) {
         if($item->BA == 'B'){
            $musteriBakiye -= $item->tutar;
         }
         if($item->BA == 'A'){
         $musteriBakiye += $item->tutar;
         }
      }
        Log::channel('stderr')->info($musteriBakiye);
        Musteri::where('id',$request->musteri_id)->update(['bakiye' => $musteriBakiye]);
        Musteri::where('id',$request->musteri_id)->update(['sonTahsilat' => Carbon::now()]);
        $muhasebeKaydi->update();
     }
     public function getHareket(Request $request)
     {
      $hareket = Muhasebe::where('id',$request->id)->first();
      
      return response()
      ->json($hareket, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
      JSON_UNESCAPED_UNICODE);

     }
     public function deleteHareket(Request $request)
     {
     $kayit = Muhasebe::where('id',$request->id)->first();
     $kayit->delete();
     $musteri_id = $kayit->musteri_id;
     $musteri = Musteri::where('id',$musteri_id)->first();
     $musteriMuhasebeKayitlari = Muhasebe::where('musteri_id',$musteri->id)->get();
     $musteriBakiye = 0;
     foreach ($musteriMuhasebeKayitlari as $key => $item) {
     if($item->BA == 'B'){
     $musteriBakiye -= $item->tutar;
     }
     if($item->BA == 'A'){
     $musteriBakiye += $item->tutar;
     }
     }
     Musteri::where('id',$musteri->id)->update(['bakiye' => $musteriBakiye]);
    
     return response()
     ->json($kayit, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
     JSON_UNESCAPED_UNICODE);

     }
      public function bakiyeKapat(Request $request)
      {
      $musteri = Musteri::where('id',$request->id)->first();
      $musteri->update(['bakiye_durum' => 0]);
      return response()
      ->json($musteri, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
      JSON_UNESCAPED_UNICODE);
      }
      public function bakiyeAc(Request $request)
    {
 $musteri = Musteri::where('id',$request->id)->first();
 $musteri->update(['bakiye_durum' => 1]);
 return response()
 ->json($musteri, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
 JSON_UNESCAPED_UNICODE);
 }
     protected function validatedData()   
     {
     return request()->validate([
      'duzeltme'=>'',
     'tutar'=>'',
     'BA'=>'',
     'musteri_id'=>'',
     ]);
     }
  }