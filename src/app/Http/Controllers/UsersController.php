<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Spot;
use Storage;

class UsersController extends Controller
{
    public function show($id){
        $user = User::find($id);
        $spots = Spot::where('user_id', $id)->paginate(10);
        return view('users.show', compact('user', 'spots'));
    }

    public function edit($id){
        $user = User::find($id);
        
        return view('users.edit', compact('user'));
    }

    public function update($id, Request $request){
        $user = User::find($id);

        $user->name = $request->name;

        $user->prefecture = $request->prefecture;

        $file = $request->file('profile_photo');
        if(app()->isLocal()){
            $file_name = $file->getClientOriginalName();
            $file->storeAs('public', $file_name);
            $user->profile_photo = $file_name;
        } else {
            $file_name = $file->getClientOriginalName();
            Storage::disk('s3')->putFile('/uploads', $file);
            $url = Storage::disk('s3')->url('uploads/'.$file_name);
            $user->profile_photo = $url;
        }


        $user->profile_introduction = $request->profile_introduction;

        $user->update();

        return redirect(route('users.show', $id));
    }
}