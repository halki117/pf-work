<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;
use App\Tag;
use App\Announcement;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SpotRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Image;
use Storage;

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
            if(app()->isLocal()){
                $file_name = $file->getClientOriginalName();
                Image::make($file)->fit(300, 300)->save(storage_path('app/public/'.$file_name));
                $image_data[] = $file_name;
            } else {
                $file_name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $resize_img = Image::make($file)->fit(300, 300)->encode($extension);
                Storage::disk('s3')->put('/uploads/'.$file_name,(string)$resize_img, 'public');
                $url = Storage::disk('s3')->url('uploads/'.$file_name);
                $image_data[] = $url;
            }
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
            if(app()->isLocal()){
                $file_name = $file->getClientOriginalName();
                Image::make($file)->fit(300, 300)->save(storage_path('app/public/'.$file_name));
                $image_data[] = $file_name;
            } else {
                $file_name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $resize_img = Image::make($file)->fit(300, 300)->encode($extension);
                Storage::disk('s3')->put('/uploads/'.$file_name,(string)$resize_img, 'public');
                $url = Storage::disk('s3')->url('uploads/'.$file_name);
                $image_data[] = $url;
            }
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

        return redirect(route('spots.show', $id))->with('success', '投稿を編集しました');
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
        $spots = $user->likes()->paginate(10);
        return view('spots.favorites', compact('user','spots'));
    }

    public function searching()
    {
        $tags = Tag::all();
        return view('spots.searching', compact('tags'));
    }


    // public function searched(SearchRequest $request)
    // { 

    //     $latitude  = $request->latitude;
    //     $longitude = $request->longitude;

    //     $query = Spot::select('*', 
    //         DB::raw('6370 * ACOS(COS(RADIANS('.$latitude.')) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS('.$longitude.')) 
    //         + SIN(RADIANS('.$latitude.')) * SIN(RADIANS(latitude))) as distance'))
    //         ->withCount('likes');
        
    //     if($request->tags){
    //         foreach($request->tags as $key => $tag_id){
    //             $query->whereHas('tags', function (Builder $query)use($key, $tag_id) {
    //                 $query->where('tags.id', $tag_id);
    //             });
    //         }
    //     }

    //     // $spots = $query->get();
    //     $sql = $query->toSql();

    //     $query2 = DB::table(DB::raw('('.$sql.') AS spot'));
    //     $query2->mergeBindings($query->getQuery());

    //     if($request->range_time){
    //         $distance1 = $array[':distance'] = $request->range_time * 80 / 1000;
    //         $query2->where('distance','<=', $distance1);
    //     }
        
    //     if($request->range_distance){
    //         $distance2 = $array[':distance'] = $request->range_distance;
    //         $query2->where('distance','<=', $distance2);
    //     }

    //     // dd($query2->toSql());
    //     if($request->sort === "order_new")
    //     {
    //         $query2->orderBy('created_at');
    //     } 
    //     elseif($request->sort === "order_likes")
    //     {
    //         $query2->orderBy('likes_count');
    //     } else {
    //         $query2->orderBy('distance');
    //     }

    //     $spots = $query2->paginate(10);

    //     $spots_collection = $spots->getCollection()->map(function($obj){
    //         $spot = new Spot;
    //         $spot->id = $obj->id;
    //         $spot->address = $obj->address;
    //         $spot->longitude = $obj->longitude;
    //         $spot->latitude = $obj->latitude;
    //         $spot->image = json_decode($obj->image, true);
    //         return $spot;
    //     });

    //     $spots = new LengthAwarePaginator(
    //         $spots_collection,
    //         $spots->total(),
    //         10,
    //         $request->page
    //     );


    //     return view('spots.searched', compact('spots'));
    // }

    
    public function searched(SearchRequest $request)
    { 

        $latitude  = $request->latitude;
        $longitude = $request->longitude;

        $query = Spot::select('*', 
            DB::raw('6370 * ACOS(COS(RADIANS('.$latitude.')) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS('.$longitude.')) 
            + SIN(RADIANS('.$latitude.')) * SIN(RADIANS(latitude))) as distance'))
            ->orderBy('distance', 'asc')
            ->withCount('likes');
        
        if($request->tags){
            foreach($request->tags as $tag_id){
                $query->whereHas('tags', function (Builder $query)use($tag_id) {
                    $query->where('tags.id', $tag_id);
                });
            }
        }

        // $spots = $query->get();
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
