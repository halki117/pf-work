<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $users = User::where('admin', false)->get();
        return view('admin.users.index', compact('users'));
    }

    public function show($id){
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }
}
