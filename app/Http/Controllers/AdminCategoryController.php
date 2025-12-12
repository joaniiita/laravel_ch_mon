<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255'
        ]);

        try {
            if (Auth::user()->role === 'admin') {
                $category = Category::create([
                    'name' => $request->get('name')
                ]);
            }
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()])->withInput();
        }

        return redirect('/admin/categories/index');
    }

    public function delete($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('/admin/categories/index');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->get('name');
        $category->save();
        return redirect('/admin/categories/index');
    }
}

