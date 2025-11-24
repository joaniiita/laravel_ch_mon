<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        $petitions = Petition::all();
        return view('pages.home', compact('petitions'));
    }
}
