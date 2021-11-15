<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();

        return view('tags.show', compact('tag'));
    }
}
