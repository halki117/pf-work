<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;
use Illuminate\Support\Facades\Auth;

class SpotsController extends Controller
{
    public function index(){
        return view('spots.index');
    }

    public function create(){
        return view('spots.create');
    }

    public function store(Request $request){
        
        $spot = new Spot;
        
        $spot->address = $request->address;
        $spot->image = $request->image;
        $spot->review = $request->review;
        if($request->public == "1"){
            $spot->public = true;
        } else {
            $spot->public = false;
        }
        $spot->latitude = $request->latitude;
        $spot->longitude = $request->longitude;
        $spot->user_id = Auth::id();

        $spot->save();

        return redirect('/spots');
    }   
}
