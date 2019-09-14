<?php


namespace App\Http\Controllers\V2;


use App\Http\Controllers\Controller;

use App\Http\Resources\V2\TripResource;
use App\Trip;
use Illuminate\Http\Request;

class TripsController extends Controller
{
    /**
     * Lista todos los viajes sin filtros.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @version v2
     */
    public function index(Request $request)
    {
        $query = Trip::query()
            ->withCount('checkpoints')
            ->with([
                'client:id,company_name',
                'truck:id,name,created_at,updated_at',
                'operator',
//                'checkpoints.place',
                'originCheckpoint' => function($query){
                    $query->with(['place' => function($query) {
                        $query->withTrashed();
                    }] );
                },
                'destinationCheckpoint' => function($query){
                    $query->with(['place' => function($query) {
                        $query->withTrashed();
                    }] );
                },
                'tags',
                'trailers',
                'carrier'
            ])

            ->orderByDesc('created_at');
        if ($request->has('filter')) {
            $query = $query->withAnyTags($request->filter);
        }
        $trips = $query->paginate();

        
        return TripResource::collection($trips);
    }
}