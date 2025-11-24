<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    public function index(){
        $petitions = Petition::all();
        return view('petitions.index', compact('petitions'));
    }

    public function show($id){
        $petition = Petition::findOrFail($id);
        $user = $petition->user;
        return view('petitions.show', compact('petition', 'user'));
    }

    public function store(Request $request){

    }
}
