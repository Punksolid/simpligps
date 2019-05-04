<?php

namespace App\Interfaces;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\Resource; // when Resource:make()
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class SearchInterface
 */
interface SearchInterface {
    public function search(Request $request);

}