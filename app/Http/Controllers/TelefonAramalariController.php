<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Musteri;
use \App\TelefonAramalari;

class TelefonAramalariController extends Controller
{
    public function telefonKaydiIsle(Request $request)
    {   

        $telefonKaydi = TelefonAramalari::create($this->validatedData());
        $telefonKaydi->arayanID = auth()->id();
        $telefonKaydi->update();


    return $telefonKaydi;
    }
     protected function validatedData()
     {

     return request()->validate([
     'musteriID'=>'required',
     'arayanID'=>'',
     ]);

     }
}