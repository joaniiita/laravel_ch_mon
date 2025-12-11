<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;

class AdminPetitionController extends Controller
{
    function index()
    {
        return view('layouts.admin');
    }

    function home(){
        $petitions = Petition::all();

        return view('admin.petitions.index', compact('petitions'));
    }
}
