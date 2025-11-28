<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetitionController extends Controller
{
    public function index()
    {
        $petitions = Petition::all();
        $files = File::all();

        return view('petitions.index', compact('petitions'));
    }

    public function show($id)
    {
        $petition = Petition::findOrFail($id);
        $user = $petition->user;
        return view('petitions.show', compact('petition', 'user'));
    }

    public function listMine()
    {
        $id = Auth::id();
        $myPetitions = Petition::where('user_id', $id)->paginate(5);

        return view('petitions.mine', compact('myPetitions'));
    }

    public function create(Request $request)
    {
//        return view('petitions.edit-add');
        return view('petitions.create');
    }

//    public function sign(Request $request, Petition $petition)
//    {
//        try {
//           $request->validate([
//               'name' => 'required',
//               'surname' => 'required',
//               'email' => 'required',
//           ]);
//
//           $user_id = Auth::id();
//           $signatures = $petition->signers;
//
//           foreach ($signatures as $signature) {
//               if ($signature->contains($user_id)) {
//                   return back()->withErrors('You have already signed this petition')->withInput();
//               }
//           }
//
//           $petition->signers()->attach($user_id);
//            $petition->signatures = $petition->signers()->count();
//            $petition->save();
//
//
//        } catch (\Exception $e) {
//            return back()->withErrors($e->getMessage())->withInput();
//        }
//
//        return redirect()->back();
//    }

    public function sign(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        try {
            $petition = Petition::findOrFail($id);
            $user = Auth::user();

            if ($petition->signers()->where('user_id', $user->id)->exists()) {
                return back()->withErrors(['Ya has firmado esta petición'])->withInput();
            }

            $petition->signers()->attach($user->id);

            $petition->signers = $petition->signers + 1;
            $petition->save();

        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()])->withInput();
        }

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'destinatary' => 'required',
            'category' => 'required',
            'image' => 'required|file|mimes:jpeg,png,jpg,svg',
        ]);

        try {
            // Tengo el nombre y tengoq ue sacar el id -> select id from categories where name = $category
            $categoryName = $request->category;
            $categoryId = Category::where('name', $categoryName)->first()->id;
            $user = Auth::user();

            $petition = Petition::create([
               'title' => $request->get('title'),
               'description' => $request->get('description'),
               'destinatary' => $request->get('destinatary'),
               'category_id' => $categoryId,
                'user_id' => $user->id,
                'signers' => 0,
                'status' => 'pending'

            ]);

            $petition->user()->associate($user->id);
            $petition->category()->associate($categoryId);

            $response = $petition->save();
            if ($response) {
                $response_file = $this->fileUpload($request, $petition->id);
                if ($response_file){
                    return redirect('/mypetitions');
                }
            } else {
                return back()->withErrors(['Error creando la petición'])->withInput();
            }

        } catch (\Exception $e){
            return back()->withErrors([$e->getMessage()])->withInput();
        }
        return redirect('/mypetitions');
    }



    public function signedPetitions()
    {
        try {
            $user = Auth::user();
            $petitions = $user->signPetition()->get();
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('petitions.signedPetitions', compact('petitions'));
    }

    private function fileUpload(Request $request, $id)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/images/petitions'), $image);
        }

        $petition = Petition::findOrFail($id);

        $petition->files()->create([
            'name' => $image,
            'file_path' => $image,
            'petition_id' => $id
        ]);

    }


}
