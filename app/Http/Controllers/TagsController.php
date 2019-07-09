<?php

namespace App\Http\Controllers;

use App\MariadbTag;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class TagsController extends Controller
{
    public function index()
    {

        $tags = MariadbTag::get(['id','name','slug']);

        return response([
            'data' => $tags
        ]);
    }
}
