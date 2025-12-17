<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required|string|min:8'
        ]);

        $user = User::findOrFail($id);

        $image = $user->image;
        if ($request->hasFile('image')) {
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/images/users'), $image);
        }

        if ($request->get('password') != null) {
            $user->password = Hash::make($request->get('password'));
        } else {
            $user->password = $user->password;
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

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->image !== 'defaultProfile.png') {
            $path = public_path('assets/images/users/' . $user->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        foreach ($user->signPetition as $petition) {
            $petition->signers()->detach($user->id);
            $petition->signers = $petition->signers()->count();
            $petition->save();
        }

        foreach ($user->petitions as $petition) {
            $petition->files()->delete();
            $petition->delete();
        }

        $user->delete();

        return redirect('/admin/users/index');
    }

}
