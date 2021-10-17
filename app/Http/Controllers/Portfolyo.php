<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Musteri;
use \App\User;
use \App\Durum;
use \App\Muhasebe;
use \App\SilinenMusteri;
use \App\TamamlananIsler;
use Illuminate\Support\Facades\Log;
use Auth;
use Carbon\Carbon;
class Portfolyo extends Controller
{
      public function __construct()
      {
      $this->middleware('auth');
      }
    public function index(){
        $tumMusteriler= Musteri::orderBy('isim', 'ASC')->get();
        $enSon = Musteri::orderBy('updated_at', 'DESC')->get();
        $seciliDurum = 6;
        $users = \App\User::all();
        $durumlar = Durum::all()->sortBy('durum_sira');
        $muhasebe = Muhasebe::all();
        $musteri = Musteri::all();
        $toplamBakiye = 0;
        $toplamTahsilEdilen = 0;
        $toplamBorclu = 0;
        $toplamBorcsuz = 0;
        $toplamBorclandirilmamis = 0;
        $toplamBorclandirilmamisArray = [];


        $buAyTahsilEdilenArray = Muhasebe::whereYear('created_at', Carbon::now()->year)
         ->whereMonth('created_at', Carbon::now()->month)
         ->where('BA','A')->get();
         $buAyTahsilEdilen = 0;
         foreach ($buAyTahsilEdilenArray as $key => $item) {
         $buAyTahsilEdilen += $item->tutar;
         }
         $bugunTahsilEdilenArray = Muhasebe::whereYear('created_at', Carbon::now()->year)
         ->whereMonth('created_at', Carbon::now()->month)
         ->whereDay('created_at', Carbon::now()->day)
         ->where('BA','A')->get();
         $bugunTahsilEdilen = 0;
         foreach ($bugunTahsilEdilenArray as $key => $item) {
             if($item->BA == 'A'){
             $bugunTahsilEdilen += $item->tutar;
             }
         }


        foreach ($musteri as $key => $item) {
            if($item->bakiye_durum == 1){

                $toplamBorclandirilmamis += 1;
                $toplamBakiye += $item->bakiye;
                if($item->bakiye >= 0){
                    $toplamBorcsuz += 1;
                }
                if($item->bakiye < 0){
                $toplamBorclu += 1;
                }
            }

        }
         foreach ($muhasebe as $key => $item) {
         if($item->BA == 'A'){
         $toplamTahsilEdilen += $item->tutar;
         }
         if(in_array($item->musteri_id,$toplamBorclandirilmamisArray) == false)
         {
         array_push($toplamBorclandirilmamisArray,$item->musteri_id);
         $toplamBorclandirilmamis -= 1;
         }
         }
        return view('portfolyo.index', compact(
        'durumlar','tumMusteriler',
        'enSon', 'seciliDurum',
        'users','toplamBakiye',
        'toplamTahsilEdilen','toplamBorclu','toplamBorcsuz',
        'toplamBorclandirilmamis','buAyTahsilEdilen',
        'bugunTahsilEdilen','bugunTahsilEdilenArray'));
    }
    // public function dgs(Request $request){
    // if($request->durum != 99){
    //     $tumMusteriler= Musteri::where('durum',$request->durum)->get();
    // }else{
    //     $tumMusteriler=Musteri::all();
    // }
    // $enSon = Musteri::orderBy('updated_at', 'DESC')->get();
    // $seciliDurum = $request->durum;
    // $users = \App\User::all();
    //     $durumlar = Durum::all()->sortBy('durum_sira');
    // return view('portfolyo.index', compact('durumlar','tumMusteriler','enSon', 'seciliDurum','users'));
    // }
    public function musteriEkle(){
        $users = \App\User::all();
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
        $durumlar = Durum::all()->sortBy('durum_sira');

        return view('portfolyo.create', compact('durumlar','users','sehirler'));

    }
    public function musteriKaydet(Request $request){
        $aranan = Musteri::where('newtelefon', $request->newtelefon)->first();
        $this->validatedData();
    if($aranan == null && $request->newtelefon != null){
        $musteri = Musteri::create($this->validatedData());
        $musteri->kayit_yapan_id = auth()->id();
        $musteri->update();
        return redirect('/portfolyo');
    }

    else{
        $error = \Illuminate\Validation\ValidationException::withMessages([
        'kisimevcut' => ['Kişi Zaten Kayıtlı'],
        ]);
        throw $error;
    }
    }
    public function musteriGuncelle(Request $request){
        Musteri::where('id',$request->id)->update(['durum' => $request->durum]);
        Musteri::where('id',$request->id)->update(['kosgebbelgesi' => $request->kosgebbelgesi]);
        Musteri::where('id',$request->id)->update(['notlar' => $request->notlar]);
        Musteri::where('id',$request->id)->update(['atanan_id' => $request->atananselect]);
        Musteri::where('id',$request->id)->update(['isim' => $request->isim]);
        Musteri::where('id',$request->id)->update(['sektor' => $request->sektor]);
        Musteri::where('id',$request->id)->update(['vergi_no' => $request->vergi_no]);
        Musteri::where('id',$request->id)->update(['sehir' => $request->sehir]);
        Musteri::where('id',$request->id)->update(['newtelefon' => $request->newtelefon]);
        Musteri::where('id',$request->id)->update(['tel2' => $request->tel2]);
        Musteri::where('id',$request->id)->update(['tc' => $request->tc]);
        Musteri::where('id',$request->id)->update(['edevlet_sifresi' => $request->edevlet_sifresi]);
        Musteri::where('id',$request->id)->update(['email' => $request->email]);
        Musteri::where('id',$request->id)->update(['email_sifresi' => $request->email_sifresi]);
        Musteri::where('id',$request->id)->update(['guncelleme_yapan_id' => auth()->id()]);
        Musteri::where('id',$request->id)->update(['onemSirasi' => $request->onemSirasi]);
        Musteri::where('id',$request->id)->update(['vergiLevhasiTarihi' => $request->vergiLevhasiTarihi]);
        Musteri::where('id',$request->id)->update(['kosgebBelgesiTarihi' => $request->kosgebBelgesiTarihi]);
        Musteri::where('id',$request->id)->update(['taahhutnameTarihi' => $request->taahhutnameTarihi]);
        Musteri::where('id',$request->id)->update(['naceKodu' => $request->naceKodu]);
              $user = Auth::user();
              $admin_mi = $user->admin_mi;
              if($request->from == 'h'){
              return redirect('/');
              }
              if($request->from == 't'){
              return redirect('/');
              }
              if($request->from == 'p' || $request->from == null){
              return redirect('/portfolyo');
              }
              
    }
    public function isTamamla(Request $request)
    {
     $tamamlananIs = TamamlananIsler::create();
     $tamamlananIs->oldid = $request->musteriID;
     $tamamlananIs->update();
     return true;
    }
    public function getMusteri(\App\Musteri $musteri){
    if($musteri->atanan_id != null){
        $atanan = User::where('id',$musteri->atanan_id)->first();
    }
    $users = \App\User::all();
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
        $durumlar = Durum::all()->sortBy('durum_sira');
        $muhasebe = Muhasebe::where('musteri_id',$musteri->id)->orderby('created_at','desc')->get();
        $bakiye = 0;
        foreach ($muhasebe as $key => $item) {
            if($item->BA == 'B'){
                $bakiye -= $item->tutar;
            }
            if($item->BA == 'A'){
            $bakiye += $item->tutar;
            }
        }
        $sifre = '3710';
        return view('portfolyo.musteridetay', compact('bakiye','durumlar','musteri','atanan','users', 'sehirler','muhasebe','sifre'));

    }
    public function musteriSil(\App\Musteri $musteri){
     $silinenMusteri = SilinenMusteri::create();
     $silinenMusteri->oldid = $musteri->id;
     $silinenMusteri->isim = $musteri->isim;
     $silinenMusteri->sehir = $musteri->sehir;
     $silinenMusteri->sektor = $musteri->sektor;
     $silinenMusteri->newtelefon = $musteri->newtelefon;
     $silinenMusteri->durum = $musteri->durum;
     $silinenMusteri->atanan_id = $musteri->atanan_id;
     $silinenMusteri->edevlet_sifresi = $musteri->edevlet_sifresi;
     $silinenMusteri->email = $musteri->email;
     $silinenMusteri->kayit_yapan_id = $musteri->kayit_yapan_id;
     $silinenMusteri->guncelleme_yapan_id = $musteri->guncelleme_yapan_id;
     $silinenMusteri->vergi_no = $musteri->vergi_no;
     $silinenMusteri->bakiye = $musteri->bakiye;
     $silinenMusteri->silme_islemi_yapan_id = auth()->id();
     $silinenMusteri->update();
     
     Musteri::find($musteri);
     $musteri->delete();
    return redirect('/portfolyo');
    }
    public function dosyaKaydet(Request $request)
    {
        $musteri_ = Musteri::where('id',$request->musteri_id)->first();
        $musteriAdi = $musteri_->isim;
        if ($request->hasFile('f1')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f1')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f1')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Girişimcilik_Belgesi'.'.'.$extension;
          $path = $request->file('f1')->storeAs('public/f1',$filenameToStore); 
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f1' => $path]);
        }
          if ($request->hasFile('f2')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f2')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f2')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Vergi_Levhasi'.'.'.$extension;
          $path = $request->file('f2')->storeAs('public/f2',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f2' => $path]);
          }
          if ($request->hasFile('f3')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f3')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f3')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Oda_Kaydi'.'.'.$extension;
          $path = $request->file('f3')->storeAs('public/f3',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f3' => $path]);
          }
          if ($request->hasFile('f4')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f4')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f4')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Faaliyet_Belgesi'.'.'.$extension;
          $path = $request->file('f4')->storeAs('public/f4',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f4' => $path]);
          }
          if ($request->hasFile('f5')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f5')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f5')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Sicil_Gazetesi'.'.'.$extension;
          $path = $request->file('f5')->storeAs('public/f5',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f5' => $path]);
          }
          if ($request->hasFile('f6')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f6')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f6')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Kobi_Beyannamesi'.'.'.$extension;
          $path = $request->file('f6')->storeAs('public/f6',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f6' => $path]);
          }
          if ($request->hasFile('f7')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f7')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f7')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Vergi_Mükellefiyet_Belgesi'.'.'.$extension;
          $path = $request->file('f7')->storeAs('public/f7',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f7' => $path]);
          }
          if ($request->hasFile('f8')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f8')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f8')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Proforma_Faturalar'.'.'.$extension;
          $path = $request->file('f8')->storeAs('public/f8',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f8' => $path]);
          }
          if ($request->hasFile('f9')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f9')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f9')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'İş_Modeli'.'.'.$extension;
          $path = $request->file('f9')->storeAs('public/f9',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f9' => $path]);
          }
          if ($request->hasFile('f10')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f10')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f10')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Başvuru_Formu'.'.'.$extension;
          $path = $request->file('f10')->storeAs('public/f10',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f10' => $path]);
          }
          if ($request->hasFile('f11')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f11')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f11')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Kurul_Karari_Formu'.'.'.$extension;
          $path = $request->file('f11')->storeAs('public/f11',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f11' => $path]);
          }
          if ($request->hasFile('f12')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f12')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f12')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Kuruluş_Talebi'.'.'.$extension;
          $path = $request->file('f12')->storeAs('public/f12',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f12' => $path]);
          }
          if ($request->hasFile('f13')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f13')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f13')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Makine_Talebi'.'.'.$extension;
          $path = $request->file('f13')->storeAs('public/f13',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f13' => $path]);
          }
          if ($request->hasFile('f14')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f14')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f14')->getClientOriginalExtension();
          $filenameToStore = $musteriAdi.'_'.'Performans_Talebi'.'.'.$extension;
          $path = $request->file('f14')->storeAs('public/f14',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f14' => $path]);
          }
          if ($request->hasFile('f15')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f15')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f15')->getClientOriginalExtension();
          $filenameToStore = $filename.'.'.$extension;
          $path = $request->file('f15')->storeAs('public/f15',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f15' => $path]);
          }
          if ($request->hasFile('f16')) {
          $destinationPath = '/';
          $fileNameWithExt = $request->file('f16')->getClientOriginalName();
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('f16')->getClientOriginalExtension();
          $filenameToStore =$filename.'.'.$extension;
          $path = $request->file('f16')->storeAs('public/f16',$filenameToStore);
          $musteri = Musteri::where('id',$request->musteri_id)->update(['f16' => $path]);
          }
           if ($request->hasFile('f17')) {
           $destinationPath = '/';
           $fileNameWithExt = $request->file('f17')->getClientOriginalName();
           $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
           $extension = $request->file('f17')->getClientOriginalExtension();
           $filenameToStore =$filename.'.'.$extension;
           $path = $request->file('f17')->storeAs('public/f17',$filenameToStore);
           $musteri = Musteri::where('id',$request->musteri_id)->update(['f17' => $path]);
           }
            if ($request->hasFile('f18')) {
            $destinationPath = '/';
            $fileNameWithExt = $request->file('f18')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('f18')->getClientOriginalExtension();
            $filenameToStore =$filename.'.'.$extension;
            $path = $request->file('f18')->storeAs('public/f18',$filenameToStore);
            $musteri = Musteri::where('id',$request->musteri_id)->update(['f18' => $path]);
            }
             if ($request->hasFile('f19')) {
             $destinationPath = '/';
             $fileNameWithExt = $request->file('f19')->getClientOriginalName();
             $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
             $extension = $request->file('f19')->getClientOriginalExtension();
             $filenameToStore =$filename.'.'.$extension;
             $path = $request->file('f19')->storeAs('public/f19',$filenameToStore);
             $musteri = Musteri::where('id',$request->musteri_id)->update(['f19' => $path]);
             }
              if ($request->hasFile('f20')) {
              $destinationPath = '/';
              $fileNameWithExt = $request->file('f20')->getClientOriginalName();
              $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
              $extension = $request->file('f20')->getClientOriginalExtension();
              $filenameToStore =$filename.'.'.$extension;
              $path = $request->file('f20')->storeAs('public/f20',$filenameToStore);
              $musteri = Musteri::where('id',$request->musteri_id)->update(['f20' => $path]);
              }
          Log::channel('stderr')->info( $request->musteri_id);  
          return back()
          ->with('success','You have successfully upload file.');
    }
    public function dosyaIndir(Request $request)
     {
         $dosyaKodu = $request->dosyaKodu;
         $id = $request->musteri;
         $musteri = Musteri::where('id',$id)->first();
         $dosyaPath = $musteri->$dosyaKodu;
         return response()->download(storage_path('app/' .$dosyaPath));
     }
   
     public function dosyaSil(Request $request)
     {
     Musteri::where('id',$request->musteri)->update([$request->dosyaKodu => '']);
   return back()
   ->with('success','You have successfully upload file.');
     }

     public function api()
     {
        $test = User::where('id',1)->first();
        
      return response()
      ->json($test, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
      JSON_UNESCAPED_UNICODE);
     }
    protected function validatedData()
       {
       return request()->validate([
       'isim'=>'required',
       'sehir'=>'required',
       'newtelefon'=>'required',
       'tel2'=>'',
       'onemSirasi'=>'',
       'sektor'=>'required',
       'atanan_id'=>'required',
       'kosgebbelgesi'=>'',
       'notlar'=>'',
       'vergi_no'=>'',
       'durum'=>'required'
       ]);
       }
}