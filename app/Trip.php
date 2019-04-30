<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Tags\HasTags;

class Trip extends Model
{
    use HasTags, UsesTenantConnection;

    protected $fillable = [
            "rp",
            "invoice",
            "client",
            "origin_id",
            "destination_id",
            "mon_type",
            "scheduled_load",
            "scheduled_departure",
            "scheduled_arrival",
            "scheduled_unload",
            "bulk",
            "georoute_ref",
        //operationals
            "device_id",
            "carrier_id",
        //tag
            "tag"
        ];

    protected $casts = [
        "bulk" => "array"
    ];

    protected $dates = [
        "scheduled_load",
        "scheduled_departure",
        "scheduled_arrival",
        "scheduled_unload"
    ];

    #region Relationships
    /**
     * Relacion al lugar de origen
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function origin()
    {
        return $this->belongsTo(Place::class,"origin_id");
    }

    /**
     * Relacion al lugar destino
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destination()
    {
        return $this->belongsTo(Place::class, "destination_id");
    }

    /**
     * El viaje tiene un dispositivo asociado
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function device()
    {
        return $this->belongsTo(Device::class, "device_id");
    }

    /**
     * Traces son todos los registros que va dejando el plan de viaje, antes Bitacora
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function traces()
    {
        return $this->hasMany(Trace::class,"trip_id");
    }

    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('order_column');
    }

    /**
     * Relacion muchos a muchos, puntos intermedios
     */
    public function places()
    {
        return $this->belongsToMany(
            Place::class,
            'places_trips',
            'place_id',
            'trip_id')
            ->withPivot([
                'order',
                'type'
            ]);
    }

    /**
     * Alias de Places con pivot intermediate
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function intermediates()
    {
        return $this->places()->wherePivot('type','=','intermediate');
    }

    /**
     * Un viaje puede tener varias Cajas (TrailerBoxes), el campo order en pivot representa el orden de las cajas
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function trailers()
    {
        return $this->belongsToMany(
            'App\TrailerBox',
            'trailer_boxes_trips',
            'trip_id',
            'trailer_box_id'
        )->withPivot([
            'order'
        ]);
    }

    /**
     * Un viaje puede tener un tracto
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function truck()
    {
        return $this->belongsTo(TruckTract::class);
    }

    /**
     * Un viaje tiene un operador asignado al viaje
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }
    #endregion

    #region actions
    /**
     * Add Intermediate Places points
     * @param Place $place
     */
    public function addIntermediate( $place_id)
    {
        return $this->places()->attach($place_id, [
            "type" => 'intermediate',
            'order' => 0
        ]);
    }

    public function addTrailerBox(int $trailer_box_id)
    {
         $this->trailers()->attach($trailer_box_id, [
            'order' => 0
        ]);
    }

    #endregion
    //    Override Tag class para aceptar mariadb
    public static function getTagClassName(): string
    {
        return MariadbTag::class;
    }
};
