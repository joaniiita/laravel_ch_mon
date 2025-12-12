<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    function create(){
        $categories = Category::all();
        return view('admin.petitions.create', compact('categories'));
    }

    function edit($id){
        $petition = Petition::findOrFail($id);
        return view('admin.petitions.edit', compact('petition'));
    }

    function update($id, Request $request){
//        $request->validate([
//            'title' => 'required|max:255',
//            'description' => 'required',
//            'destinatary' => 'required',
//            'status' => 'required',
//            'category' => 'required',
//        ]);
    }
}
