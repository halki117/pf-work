<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Spot;

class UsersController extends Controller
{
    public function show($id){
        $user = User::find($id);
        $spots = Spot::where('user_id', $id)->get();
        return view('users.show', compact('user', 'spots'));
    }
}
