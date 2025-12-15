<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'role' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,jpg',
        ]);

        $user = User::findOrFail($id);

        $image = $user->image;
        if ($request->hasFile('image')) {
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/images/users'), $image);
        }


        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->image = $image;
        $user->role = $request->get('role');
        $user->update();

        return redirect('/admin/users/index');
    }
    public function show($id){
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function delete($id){
        $user = User::findOrFail($id);

        $image = $user->image;
        $imagePath = public_path('assets/images/users/' . $image);

        if($image && file_exists($imagePath)){
            if(!unlink($imagePath)){
                return back()->withErrors("No se ha podido eliminar la imagen")->withInput();
            }
        }

        $user->delete();
        return redirect('/admin/users/index');
    }

}
