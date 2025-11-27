<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoyagerUserController extends Controller
{
    public function signedPetitions()
    {
        try {
            $id = Auth::id();
            $user = User::findOrFail($id);
            $petitions = $user->signPetition;
        }catch (\Exception $exception){
            return back()->withError( $exception->getMessage())->withInput();
}
        return view('peticiones.index', compact('petitions'));
    }

}
