<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Spot;

class SpotsController extends Controller
{
    public function index(){
        $spots = Spot::all();
        return view('admin.spots.index', compact('spots'));
    }

    public function show($id){
        $spot = Spot::find($id);
        return view('admin.spots.show', compact('spot'));
    }
}
