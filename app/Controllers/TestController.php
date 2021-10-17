<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $coolString = 'Hello from Routes AGAIN.';

        return view('test',compact('coolString'));
    }

}
