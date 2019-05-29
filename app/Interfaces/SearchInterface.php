<?php

namespace App\Interfaces;

use Illuminate\Http\Resources\Json\Resource; // when Resource:make()
use Illuminate\Http\Request;

/**
 * Class SearchInterface.
 */
interface Search
{
    public function search(Request $request);
}
