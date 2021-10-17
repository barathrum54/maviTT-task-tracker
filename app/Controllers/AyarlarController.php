<?php

namespace App\Http\Controllers;
use \App\Kategori;
use \App\User;
use \App\Task;
use \App\Musteri;

use Illuminate\Http\Request;

class AyarlarController extends Controller
{
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
        $tumMusteriler= Musteri::where('atanan_id',$user->id)->paginate(10, ['*'],'tumMusteriler');

        return view('ayarlar.kullanicidetay',compact(
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
    protected function validatedData()
    {

      return request()->validate([
            'baslik'=>'required',
        ]);

    }
}
