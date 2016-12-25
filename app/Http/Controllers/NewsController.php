<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function index()
    {

        $user = session()->all();

        return view('news.index', compact('user'));
    }

}

