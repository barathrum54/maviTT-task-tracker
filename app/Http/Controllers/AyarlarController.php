<?php

namespace App\Http\Controllers;
use \App\Kategori;
use \App\User;
use \App\Task;
use \App\Musteri;
use \App\Durum;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AyarlarController extends Controller
{ public function __construct()
{
$this->middleware('auth');
}
    //
    public function index()
    {
        $tumkategoriler = \App\Kategori::all();
        return view('ayarlar.index', compact('tumkategoriler'));
    }
    public function kategoriEkle()
    {
       
        return view('ayarlar.kategoriEkle');
    }  
     public function kategoriEklestore (Request $request)
    {
        $kategori = Kategori::create($this->validatedData());

        return redirect('/ayarlar');
    }
    public function kullanicilariYonet()
    {
        $users = User::all();
        
        foreach ($users as $key => $user) {
            
            $user->BuHaftaBitirilen = Musteri::where([
            ['atanan_id',$user->id],
            ['durum',13]
            ])->whereBetween('updated_at', [now()->startOfWeek(),now()->endOfWeek()])->count();
            $user->BuAyBitirilen = Musteri::where([
            ['atanan_id',$user->id],
          ['durum',13]
            ])->whereBetween('updated_at', [now()->startOfMonth(),now()->endOfMonth()])->count();
            $user->ToplamBitirilen = Musteri::where([
            ['atanan_id',$user->id],
            ['durum',13]
            ])->count();
            $user->AktifProjeler = Musteri::where([
            ['atanan_id',$user->id],
            ['durum','!=',13],
            ['durum','!=',14]
            ])->count();

        }
        $newUsers = $users->sortByDesc('BuHaftaBitirilen');
        
        return view('ayarlar.kullanicilar',compact('newUsers','users'));
    }
    public function kullanicilarEdit(\App\User $user)
    {

        $bitirilenGorevList = Musteri::where([
        ['atanan_id',$user->id],
        ['durum',13]]);
        $bitirilenGorev = $bitirilenGorevList->count();

        $aktifGorevList = Musteri::where([
        ['atanan_id',$user->id],
        ['durum','!=',13],
        ['durum','!=',14]]);
        $aktifGorev = $aktifGorevList->count();

        $iptalGorevList = Musteri::where([
        ['atanan_id',$user->id],
        ['durum',14]]);
        $iptalGorev = $iptalGorevList->count();
        $AktifProjeler = Musteri::where([
        ['atanan_id',$user->id],
        ['durum','!=',13],
        ['durum','!=',14]
        ])->count();
        $tumMusteriler= Musteri::where('atanan_id',$user->id)->get();
     $durumlar = Durum::all();

        return view('ayarlar.kullanicidetay',compact(
            'durumlar',
            
            'user',
            'bitirilenGorev',
            'bitirilenGorevList',
            'aktifGorev',
            'aktifGorevList',
            'AktifProjeler',
            'iptalGorev',
            'iptalGorevList',
            'tumMusteriler'));
    }
    public function durumDuzenle()
    {
     $durumlar = Durum::all()->sortBy('durum_sira');
    return view('ayarlar.durumduzenle',compact('durumlar'));
    }
    
    public function durumkaydet(Request $request)
      {
      $degisecekdurumlar = [];
      foreach ($request->idsInOrder as $key => $durum) {
          $item = [
             "id" => $durum,
            'sira' => $key
          ];
          array_push($degisecekdurumlar,$item);
        }
        Log::channel('stderr')->info($degisecekdurumlar);
        foreach ($degisecekdurumlar as $key => $durum) {
            Durum::where('id',$durum["id"])->update(['durum_sira' => $durum["sira"]]);
        }
       $durumlar = Durum::all()->sortBy('durum_sira');

      return view('ayarlar.durumduzenle',compact('durumlar'));

      }
    protected function validatedData()
    {

      return request()->validate([
            'baslik'=>'required',
        ]);

    }
}