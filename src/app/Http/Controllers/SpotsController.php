<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;
use App\Tag;
use App\Announcement;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SpotRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Image;

class SpotsController extends Controller
{
    public function index(){
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        $new_spots = Spot::orderBy('created_at', 'desc')->limit(3)->get();
        $popular_spots = Spot::withCount('likes')->orderBy('likes_count', 'desc')->limit(3)->get();
        return view('spots.index', compact('new_spots', 'popular_spots', 'announcements'));
    }


    public function show($id){
        $spot = Spot::find($id);
        return view('spots.show', compact('spot'));
    }


    public function create(){
        $allTagNames = Tag::all()->map(function($tag){
            return ['text' => $tag->name];
        });

        return view('spots.create', compact('allTagNames'));
    }


    public function store(SpotRequest $request){

        $spot = new Spot;
        
        $spot->address = $request->address;

        $image_data = array();

        $files = $request->file('image');
        foreach($files as $file){
            $file_name = $file->getClientOriginalName();
            // dd($file_name);
            $file->storeAs('public', $file_name);
            // Image::make($file)->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->save(public_path('/' . $file_name ));
            // Image::make('app/storage/public/'.$file_name)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('/' . $file_name ));
            // Image::make(storage_path('app/public/'.$file_name))->fit(300, 300)->save(storage_path('app/public/'.$file_name));
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

        $request->tags->each(function($tagName) use ($spot){
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $spot->tags()->attach($tag);
        });


        return redirect('/spots');
    }


    public function edit($id){
        $spot = Spot::find($id);

        $tagNames = $spot->tags->map(function($tag){
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function($tag){
            return ['text' => $tag->name];
        });

        return view('spots.edit', compact('spot', 'tagNames', 'allTagNames'));
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

        $spot->tags()->detach();
        $request->tags->each(function ($tagName) use ($spot) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $spot->tags()->attach($tag);
        });

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


    public function like(Request $request, $id){
        $spot = Spot::find($id);
        $spot->likes()->detach($request->user()->id);
        $spot->likes()->attach($request->user()->id);

        // 通知機能
        $notification = app()->make('App\Http\Controllers\NotificationsController');
        $notifer_id = Auth::id();
        $passive_user_id = $spot->user_id;
        $passive_spot_id = $spot->id;
        $notice_type = 'like';
        $notification->store($notifer_id, $passive_user_id, $passive_spot_id, $notice_type);
        //

        return [
            'id' => $spot->id,
            'countLikes' => $spot->count_likes,
        ];
    }


    public function unlike(Request $request, $id)
    {
        $spot = Spot::find($id);
        $spot->likes()->detach($request->user()->id);

        return [
            'id' => $spot->id,
            'countLikes' => $spot->count_likes,
        ];
    }
    
    public function favorites() {
        $user = Auth::user();
        $spots = $user->likes;
        return view('spots.favorites', compact('user','spots'));
    }

    public function searching()
    {
        $tags = Tag::all();
        return view('spots.searching', compact('tags'));
    }


    public function searched(Request $request)
    { 

        $latitude  = $request->latitude;
        $longitude = $request->longitude;

        $query = Spot::select('*', 
            DB::raw('6370 * ACOS(COS(RADIANS('.$latitude.')) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS('.$longitude.')) 
            + SIN(RADIANS('.$latitude.')) * SIN(RADIANS(latitude))) as distance'))
            ->orderBy('distance')
            ->withCount('likes');
        
        if($request->tags){
            foreach($request->tags as $tag_id){
                $query->whereHas('tags', function (Builder $query)use($tag_id) {
                    // dd($tag_id);
                    $query->where('tags.id', $tag_id);
                });
            }
        }

        $spots = $query->get();

        if($request->range_time){
            $spots = $spots->filter(function($value){
                global $request;
                return $value->distance <= ($request->range_time * 80 / 1000);
            });
        }
        
        if($request->range_distance){
            $spots = $spots->filter(function($value){
                global $request;
                return $value->distance <= $request->range_distance;
            });
        }

        if($request->sort === "order_new")
        {
            $spots = $spots->sortByDesc('created_at');
        } 
        elseif($request->sort === "order_likes")
        {
            $spots = $spots->sortByDesc('likes_count');
        }

        return view('spots.searched', compact('spots'));
    }

}
