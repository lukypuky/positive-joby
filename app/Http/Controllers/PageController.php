<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skusenost;

class PageController extends Controller
{
    public function getIndex()
    {   
        $test=Skusenost::all();
        return view('/welcome', ['testik' => $test]);
    }
}
