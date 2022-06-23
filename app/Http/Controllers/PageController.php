<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;

class PageController extends Controller
{
    public function getIndex()
    {   
        return view('/index');
    }
}
