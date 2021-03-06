<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Musteri;
use \App\Durum;

class YonetimController extends Controller
{
       public function index()
       {

       return view('yonetim.index');

       }
       public function dagilimRaporlari()
       {
               $musteri = Musteri::all();
               $durumlar = Durum::all();
               $sehirler = [];
               $musteriler = [];
               $aySayisi = [];
               foreach ($musteri as $m) {
               array_push($musteriler, ["sektor"=>$m->sektor, "sehir" => $m->sehir, "durum" => $m->durum, "isim" =>
               $m->isim]);
               }
               $sehirSayisi = array_count_values(array_column($musteriler, 'sehir'));
               $aySayisiRaw = Musteri::selectRaw("MONTH(created_at) as month")->get();
               foreach ($aySayisiRaw as $a) {
               array_push($aySayisi, ["month" => $a->month]);
               }
               $aySayisi = array_count_values(array_column($aySayisi, 'month'));

               $sektorSayisi = array_count_values(array_column($musteriler, 'sektor'));
               $durumSayisi = array_count_values(array_column($musteriler, 'durum'));
               return view('yonetim.dagilimRaporlari', compact(
               'musteri','sehirSayisi','musteriler','aySayisi','sektorSayisi','durumSayisi','durumlar'));
       }
       public function gsi()
       {
       
       return '3710';

       }
       public function charts()
       {
              $musteri = Musteri::all();

              $sehirler = [];
              $musteriler = [];
              $aySayisi = [];
              foreach ($musteri as $m) {
              array_push($musteriler, ["sektor" => $m->sektor,"sehir" => $m->sehir, "isim" => $m->isim]);
              }
              $sehirSayisi = array_count_values(array_column($musteriler, 'sehir'));
              $sehirSayisi = json_encode($sehirSayisi);
              $aySayisiRaw = Musteri::selectRaw("MONTH(created_at) as month")->get();
              foreach ($aySayisiRaw as $a) {
              array_push($aySayisi, ["month" => $a->month]);
              }
              $aySayisi = array_count_values(array_column($aySayisi, 'month'));
              $aySayisi = json_encode($aySayisi);
              
              return compact(
              'musteri','sehirSayisi','musteriler','aySayisi');
       }
       public function sehirler()
       {
              $sehirler = [
              'Yok',
              'Adana',
              'Ad??yaman',
              'Afyon',
              'A??r??',
              'Amasya',
              'Ankara',
              'Antalya',
              'Artvin',
              'Ayd??n',
              'Bal??kesir',
              'Bilecik',
              'Bing??l',
              'Bitlis',
              'Bolu',
              'Burdur',
              'Bursa',
              '??anakkale',
              '??ank??r??',
              '??orum',
              'Denizli',
              'Diyarbak??r',
              'Edirne',
              'Elaz????',
              'Erzincan',
              'Erzurum',
              'Eski??ehir',
              'Gaziantep',
              'Giresun',
              'G??m????hane',
              'Hakk??ri',
              'Hatay',
              'Isparta',
              'Mersin',
              '??stanbul',
              '??zmir',
              'Kars',
              'Kastamonu',
              'Kayseri',
              'K??rklareli',
              'K??r??ehir',
              'Kocaeli',
              'Konya',
              'K??tahya',
              'Malatya',
              'Manisa',
              'Kahramanmara??',
              'Mardin',
              'Mu??la',
              'Mu??',
              'Nev??ehir',
              'Ni??de',
              'Ordu',
              'Rize',
              'Sakarya',
              'Samsun',
              'Siirt',
              'Sinop',
              'Sivas',
              'Tekirda??',
              'Tokat',
              'Trabzon',
              'Tunceli',
              '??anl??urfa',
              'U??ak',
              'Van',
              'Yozgat',
              'Zonguldak',
              'Aksaray',
              'Bayburt',
              'Karaman',
              'K??r??kkale',
              'Batman',
              '????rnak',
              'Bart??n',
              'Ardahan',
              'I??d??r',
              'Yalova',
              'Karab??k',
              'Kilis',
              'Osmaniye',
              'D??zce'];
              $aylar = ['Ocak','??ubat','Mart','Nisan','May??s','Haziran','Temmuz','A??ustos','Eyl??l','Ekim','Kas??m','Aral??k'];
                return compact(
                'sehirler','aylar');
       }
}