<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;
use Illuminate\Support\Facades\Auth;

class SpotsController extends Controller
{
    public function index(){
        $spots = Spot::all();
        return view('spots.index', compact('spots'));
    }

    public function show($id){
        $spot = Spot::find($id);
        return view('spots.show', compact('spot'));
    }

    public function create(){ 
        return view('spots.create');
    }

    public function store(Request $request){

        $spot = new Spot;
        
        $spot->address = $request->address;

        $image_data = array();

        $files = $request->file('image');
        foreach($files as $file){
            $file_name = $file->getClientOriginalName();
            $file->storeAs('public', $file_name);
            $image_data[] = $file_name;
        }

        $spot->image = $image_data;

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

    public function edit($id){
        $spot = Spot::find($id);
        return view('spots.edit', compact('spot'));
    }

    public function update($id, Request $request){
        $spot = Spot::find($id);
        $spot->address = $request->address;

        $image_data = array();

        $files = $request->file('image');
        foreach($files as $file){
            $file_name = $file->getClientOriginalName();
            $file->storeAs('public', $file_name);
            $image_data[] = $file_name;
        }

        $spot->image = $image_data;

        $spot->review = $request->review;

        if($request->public == "1"){
            $spot->public = true;
        } else {
            $spot->public = false;
        }

        $spot->latitude = $request->latitude;
        $spot->longitude = $request->longitude;

        $spot->update();
        return redirect('/spots');
    }
}
