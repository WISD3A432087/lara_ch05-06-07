<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function getIndex()
    {
        return view('board');
    }
}

