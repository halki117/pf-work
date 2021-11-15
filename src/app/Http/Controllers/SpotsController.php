<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SpotRequest;
use Intervention\Image\Facades\Image;

class SpotsController extends Controller
{
    public function index(){
        $spots = Spot::orderBy('created_at', 'desc')->limit(3)->get();
        return view('spots.index', compact('spots'));
    }

    public function show($id){
        $spot = Spot::find($id);
        return view('spots.show', compact('spot'));
    }

    public function create(){ 
        return view('spots.create');
    }

    public function store(SpotRequest $request){

        $spot = new Spot;
        
        $spot->address = $request->address;

        $image_data = array();

        $files = $request->file('image');
        foreach($files as $file){
            $file_name = $file->getClientOriginalName();
            $file->storeAs('public', $file_name);
            // Image::make($file)->resize(1080, null, function ($constraint) {$constraint->aspectRatio();})->storeAs('public', $file_name);
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

    public function update($id, SpotRequest $request){
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
        return redirect('spots');
    }

    public function destroy($id){
        $spot = Spot::find($id);
        if (Auth::id() !== $spot->user_id){
            return redirect(route('posts.index'))->with('danger', '許可されていない操作です');
        }
        $spot->delete();
        return redirect(route('spots.index'))->with('success', '投稿を削除しました');
    }

    public function like(SpotRequest $request, $id){
        $spot = Spot::find($id);
        $spot->likes()->detach($request->user()->id);
        $spot->likes()->attach($request->user()->id);

        return [
            'id' => $spot->id,
            'countLikes' => $spot->count_likes,
        ];
    }

    public function unlike(SpotRequest $request, $id)
    {
        $spot = Spot::find($id);
        $spot->likes()->detach($request->user()->id);

        return [
            'id' => $spot->id,
            'countLikes' => $spot->count_likes,
        ];
    }
    
}
