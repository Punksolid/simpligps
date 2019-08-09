<?php

namespace App\Http\Controllers;

use App\MariadbTag;

class TagsController extends Controller
{
    public function index()
    {
        $tags = MariadbTag::get(['id', 'name', 'slug']);

        return response([
            'data' => $tags,
        ]);
    }
}
