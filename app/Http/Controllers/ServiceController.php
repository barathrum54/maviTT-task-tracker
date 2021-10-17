<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{ public function __construct()
{
$this->middleware('auth');
}
    public function index()
    {
        

        $services = \App\Personel::all();
        return view('service.index',compact('services'));

    }
    
    public function store()
    {

        $data = request()->validate([
            'name'=>'required'
        ]);
        \App\Personel::create($data);
   

        return redirect()->back();
    }
}