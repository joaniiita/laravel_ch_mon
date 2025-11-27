<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Petition;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        $petitions = Petition::all();
        $categories = Category::all();
        return view('pages.home', compact('petitions', 'categories'));
    }
}
