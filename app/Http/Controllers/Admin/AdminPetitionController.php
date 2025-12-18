<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Petition;

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
        $categories = Category::all();
        return view('admin.petitions.edit', compact('petition', 'categories'));
    }

    function show($id){
        $petition = Petition::findOrFail($id);
        return view('admin.petitions.show', compact('petition'));
    }

    function changeStatus($id){
        $petition = Petition::findOrFail($id);

        if ($petition->status === 'pending'){
            $petition->status = 'accepted';
        } else {
            $petition->status = 'pending';
        }

        $petition->save();

        return redirect('/admin/petitions/index');
    }


}
