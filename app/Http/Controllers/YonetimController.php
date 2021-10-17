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
              'Adıyaman',
              'Afyon',
              'Ağrı',
              'Amasya',
              'Ankara',
              'Antalya',
              'Artvin',
              'Aydın',
              'Balıkesir',
              'Bilecik',
              'Bingöl',
              'Bitlis',
              'Bolu',
              'Burdur',
              'Bursa',
              'Çanakkale',
              'Çankırı',
              'Çorum',
              'Denizli',
              'Diyarbakır',
              'Edirne',
              'Elazığ',
              'Erzincan',
              'Erzurum',
              'Eskişehir',
              'Gaziantep',
              'Giresun',
              'Gümüşhane',
              'Hakkâri',
              'Hatay',
              'Isparta',
              'Mersin',
              'İstanbul',
              'İzmir',
              'Kars',
              'Kastamonu',
              'Kayseri',
              'Kırklareli',
              'Kırşehir',
              'Kocaeli',
              'Konya',
              'Kütahya',
              'Malatya',
              'Manisa',
              'Kahramanmaraş',
              'Mardin',
              'Muğla',
              'Muş',
              'Nevşehir',
              'Niğde',
              'Ordu',
              'Rize',
              'Sakarya',
              'Samsun',
              'Siirt',
              'Sinop',
              'Sivas',
              'Tekirdağ',
              'Tokat',
              'Trabzon',
              'Tunceli',
              'Şanlıurfa',
              'Uşak',
              'Van',
              'Yozgat',
              'Zonguldak',
              'Aksaray',
              'Bayburt',
              'Karaman',
              'Kırıkkale',
              'Batman',
              'Şırnak',
              'Bartın',
              'Ardahan',
              'Iğdır',
              'Yalova',
              'Karabük',
              'Kilis',
              'Osmaniye',
              'Düzce'];
              $aylar = ['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'];
                return compact(
                'sehirler','aylar');
       }
}