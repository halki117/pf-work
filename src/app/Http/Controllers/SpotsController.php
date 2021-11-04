<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpotsController extends Controller
{
    public function index(){
        return view('spots.index');
    }

    public function create(){
        return view('spots.create');
    }
}
