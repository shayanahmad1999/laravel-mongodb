<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    protected function unauthorized($user){
        if(auth()->id() !== $user->id){
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return view('profiles.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->unauthorized($user);
        return view('profiles.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->unauthorized($user);

        $data = $request->validate([
            'name'=> 'required',
            'username'=> 'required',
            'bio'=> 'required',
            'profile_image'=> 'image|nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('profile_image')){
            if($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $imagePath = $request->file('profile_image')->store('profile', 'public');
            $data['profile_image'] = $imagePath;
        }

        $user->update($data);

        return redirect("/profiles/{$user->id}");
    }

}
