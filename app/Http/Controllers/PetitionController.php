<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PetitionController extends Controller
{
    public function index()
    {
        $petitions = Petition::all();

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
        $categories = Category::all();
        return view('petitions.create', compact('categories'));
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
            if (Auth::check() && ($user->email === $request->email)) {

                if ($petition->signers()->where('user_id', $user->id)->exists()) {
                    return back()->withErrors(['Ya has firmado esta petición'])->withInput();
                }

                $petition->signers()->attach($user->id);

                $petition->signers = $petition->signers + 1;
                $petition->save();
            } else {
                return back()->withErrors(['Email incorrecto'])->withInput();
            }

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

           if (Auth::check()) {
               $user = Auth::user();

               $petition = Petition::create([
                   'title' => $request->get('title'),
                   'description' => $request->get('description'),
                   'destinatary' => $request->get('destinatary'),
                   'category_id' => $request->get('category'),
                   'user_id' => $user->id,
                   'signers' => 0,
                   'status' => 'pending'

               ]);

               if ($request->hasFile('image')) {
                   $response_file = $this->fileUpload($request, $petition->id);
                   if ($response_file){
                       return redirect('/mypetitions');
                   }
               } else {
                   return back()->withErrors(['Error creando la petición'])->withInput();
               }
           }

        } catch (\Exception $e){
            return back()->withErrors([$e->getMessage()])->withInput();
        }

        if (Auth::user()->role === 'admin'){
            return redirect('/admin/petitions/index');
        } else {
            return redirect('/mypetitions');
        }
    }

    public function edit($id){
        $petition = Petition::findOrFail($id);
        $categories = Category::all();
        return view('petitions.edit', compact('petition', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'destinatary' => 'required',
            'category' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,svg'
        ]);

        try {
            $petition = Petition::findOrFail($id);
            if (Auth::id() === $petition->user_id) {
                $oldFile = File::where('petition_id', $petition->id)->first();

                if ($request->hasFile('image')) {

                    if ($oldFile) {
                        $oldPath = public_path($oldFile->file_path);

                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }

                        $oldFile->delete();
                    }

                    $image = $request->file('image');
                    $newName = time() . '_' . $image->getClientOriginalName();
                    $destination = 'assets/images/petitions/';
                    $image->move(public_path($destination), $newName);

                    File::create([
                        'name' => $newName,
                        'file_path' => $newName,
                        'petition_id' => $petition->id
                    ]);
                }



                $petition->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'destinatary' => $request->destinatary,
                    'category_id' => $request->category,
                    'status' => 'pending',
                ]);
            }

        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()])->withInput();
        }

        return redirect('/mypetitions');
    }


//    public function update(Request $request, $id)
//    {
//        $request->validate([
//            'title' => 'required|max:255',
//            'description' => 'required',
//            'destinatary' => 'required',
//            'category' => 'required',
//            'image' => 'nullable|file|mimes:jpeg,png,jpg,svg'
//        ]);
//
//        try {
//
//            $petition = Petition::findOrFail($id);
//
//            $categoryName = $request->category;
//            $categoryId = Category::where('name', $categoryName)->first()->id;
//
//            $petition->title = $request->title;
//            $petition->description = $request->description;
//            $petition->destinatary = $request->destinatary;
//            $petition->category_id = $categoryId;
//            $petition->status = 'pending';
//            $petition->save();
//
//            if ($request->hasFile('image')) {
//                $file = $request->file('image');
//                $path = $file->store('petitions', 'public');
//
//                if ($petition->files) {
//                    $petition->files->file_path = $path;
//                    $petition->files->save();
//                } else {
//                    $petition->files()->create([
//                        'file_path' => $path,
//                    ]);
//                }
//            }
//
//        } catch (\Exception $e){
//            return back()->withErrors([$e->getMessage()])->withInput();
//        }
//
//        return redirect('/mypetitions');
//    }



    public function delete($id){
        if (Auth::check()) {
            $petition = Petition::findOrFail($id);
            $petition_img = File::where('petition_id', $petition->id)->first();

            if ($petition_img) {
                $petition_path = public_path($petition_img->file_path);

                if (file_exists($petition_path)) {
                    unlink($petition_path);
                }

                $petition_img->delete();
            }


            $petition->delete();

        }
        if (Auth::user()->role === 'admin'){
            return redirect('/admin/petitions/index');
        } else {
            return redirect('/mypetitions');
        }
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
