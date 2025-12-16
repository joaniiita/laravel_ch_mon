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

    public function delete($id){
        $user = User::findOrFail($id);
        $petitions = Petition::where('user_id', $user->id)->get();
        $signatures = $user->signPetition()->get();

        $image = $user->image;
        $imagePath = public_path('assets/images/users/' . $image);

        if ($image !== 'defaultProfile.png' && file_exists($imagePath)) {
            if(!unlink($imagePath)){
                return back()->withErrors("No se ha podido eliminar la imagen")->withInput();
            }
        }

        foreach ($signatures as $signature) {
           $petition = Petition::where('id', $signature->petition_id)->first();
            if ($petition) {
                $petition->signers = $petition->signers - 1;
                $petition->save();
            }
        }

        foreach ($petitions as $petition) {
            if ($petition->user_id === $user->id){
                $petition->files()->delete();
                $petition->delete();
            }
        }



        $user->delete();
        return redirect('/admin/users/index');
    }

}
