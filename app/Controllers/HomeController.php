<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Task;
use \App\User;
use \App\Pano;
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
          ])->paginate(3);
      $aktifProjeler = \App\Musteri::where([
      ['atanan_id',auth()->id()],
      ['durum','!=','13'],
      ['durum','!=','14']
      ])->paginate(3);

      $users = User::all();

      $pano = Pano::orderBy('id', 'desc')->take(3)->get();

      $bugunBitirilen = Task::where([
        ['AKTIF',0],['updated_at','>=', Carbon::today()]
      ])->get();
      $bugunBitirilen = $bugunBitirilen->count();

      $buAyBitirilen = Task::where('AKTIF',0)->whereMonth('updated_at', Carbon::now()->month)->get();

      
      $buAyBitirilen = $buAyBitirilen->count();

      return view('landing', compact('blogPosts',
      'aktifGorevler',
      'users',
      'pano',
      'bugunBitirilen',
      'buAyBitirilen',
      'aktifProjeler'));
    }
}
