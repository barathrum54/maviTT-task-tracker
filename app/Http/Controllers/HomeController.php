<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Task;
use \App\User;
use \App\Pano;
use \App\Durum;
use \App\Muhasebe;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $bitirilmisGorevler = \App\Task::where('AKTIF',0)->get();
        return view('home', compact('user', 'bitirilmisGorevler'));
    }
    public function getHome()
    {
      $kullaniciID = auth()->id();
      User::where('id', $kullaniciID)->update(['songiris' => now()]);
      $blogPosts = \App\BlogPost::paginate(3, ['*'],'bp');
        Task::where([
        ['atanan_id',auth()->id()],
        ['goruldu',0]])->update(['goruldu' => 1]);

      $aktifGorevler = \App\Task::where([
          ['atanan_id',auth()->id()],
          ['AKTIF',1]
          ])->get();
      $aktifProjeler = \App\Musteri::where([
      ['atanan_id',auth()->id()],
      ['durum','!=','13'],
      ['durum','!=','14']
      ])->get();
      $aktifProjelerSG = \App\Musteri::where([
      ['atanan_id',auth()->id()],
      ['durum','!=','13'],
      ['durum','!=','14']
      ])->orderBy('updated_at','desc')->get();
      $users = User::all();

      $pano = Pano::orderBy('id', 'desc')->take(3)->get();

      $bugunBitirilen = Task::where([
        ['AKTIF',0],['updated_at','>=', Carbon::today()]
      ])->get();
      $bugunBitirilen = $bugunBitirilen->count();

      $buAyBitirilen = Task::where('AKTIF',0)->whereMonth('updated_at', Carbon::now()->month)->get();

      
      $buAyBitirilen = $buAyBitirilen->count();
      $durumlar = Durum::all();
      
      $telefonGorusmeleri = [];
      $aramaAtamalari = User::where('id',$kullaniciID)->first();
      $aramaAtamalari = $aramaAtamalari->aramalar;
      $aramaAtamalari = substr($aramaAtamalari, 1);
      $aramaAtamalari = substr($aramaAtamalari, 0,-1);
      $aramaAtamalari = explode(',',$aramaAtamalari);
      if($aramaAtamalari != null || $aramaAtamalari != ''){
       foreach ($aramaAtamalari as $key => $id) {
         $musteri = \App\Musteri::where('id',$id)->first();
         if($musteri != null){

           if($musteri->durum == 0){
             array_push($telefonGorusmeleri,$musteri);
            }
          }
       }
      }
      $onemliDosyalarAtanan = \App\Musteri::where([
      ['atanan_id',auth()->id()],
      ['onemSirasi','3'],
      ])->orderBy('updated_at','desc')->get();
      $onemliDosyalarTumu = \App\Musteri::where([
      ['onemSirasi','3'],
      ])->orderBy('updated_at','desc')->get();

      $bugunEklenenMusteri = \App\Musteri::where([
      ['created_at','>=', Carbon::today()]
      ])->get();
      $bugunEklenenMusteriSayisi = $bugunEklenenMusteri->count();

      $bugunGuncellenenMusteri = \App\Musteri::where([
      ['updated_at','>=', Carbon::today()]
     ])->get();
     $bugunGuncellenenMusteriSayisi = $bugunGuncellenenMusteri->count();
  
      $bugunArananMusteri = \App\TelefonAramalari::where([
      ['updated_at','>=', Carbon::today()]
      ])->get();
      $bugunArananMusteriSayisi = $bugunArananMusteri->count();
      
      $bugunTamamlananIsler = \App\TamamlananIsler::where([
      ['updated_at','>=', Carbon::today()]
      ])->get();
      $bugunTamamlananIslerSayisi = $bugunTamamlananIsler->count();

      $bugunSilinenIsler = \App\SilinenMusteri::where([
      ['updated_at','>=', Carbon::today()]
      ])->get();
      $bugunSilinenIslerSayisi = $bugunSilinenIsler->count();
      
      $bugunTahsilEdilenArray = Muhasebe::whereYear('created_at', Carbon::now()->year)
         ->whereMonth('created_at', Carbon::now()->month)
      ->whereDay('created_at', Carbon::now()->day)
      ->where('BA','A')->get();

      $bugunYapilanTahsilat = 0;
      $bugunAcilanBorc = 0;
       foreach ($bugunTahsilEdilenArray as $key => $item) {
             if($item->BA == 'A'){
             $bugunYapilanTahsilat += $item->tutar;
             }
              if($item->BA == 'B'){
             $bugunAcilanBorc += $item->tutar;
             }
         }

      return view('landing', compact('blogPosts',
      'aktifGorevler',
      'users',
      'durumlar',
      'pano',
      'bugunBitirilen',
      'buAyBitirilen',
      'aktifProjeler',
      'telefonGorusmeleri',
      'onemliDosyalarAtanan',
      'onemliDosyalarTumu',
      'aktifProjelerSG',
      'bugunEklenenMusteriSayisi',
      'bugunEklenenMusteri',
      'bugunArananMusteri',
      'bugunArananMusteriSayisi',
      'bugunTamamlananIsler',
      'bugunTamamlananIslerSayisi',
      'bugunSilinenIsler',
      'bugunSilinenIslerSayisi',
      'bugunYapilanTahsilat',
      'bugunAcilanBorc',
      'bugunGuncellenenMusteriSayisi'

    ));
    }
}