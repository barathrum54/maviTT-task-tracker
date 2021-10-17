<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjandaController extends Controller
{
     public function index()
     {
     return view('ajanda.index');
     }
}