<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\DB;
use Spatie\Tags\Tag;

/**
 * Class MariadbTag
 * @package App
 * Clase exclusivamente para sobreescribir el comportamiento de laravel-tags y ser compatible con mariadb y mysql
 */
class MariadbTag extends Tag
{
    use UsesTenantConnection;

    protected $table = "tags";

    protected static function convertToTags($values, $type = null, $locale = null)
    {
        return collect($values)->map(function ($value) use ($type, $locale) {
            if ($value instanceof Tag) {
                if (isset($type) && $value->type != $type) {
                    throw new InvalidArgumentException("Type was set to {$type} but tag is of type {$value->type}");
                }

                return $value;
            }

            $className = static::getTagClassName();

            return $className::findFromString($value, $type, $locale);
        });
    }

    public static function findFromString(string $name, string $type = null, string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return static::query()
            ->whereRaw("JSON_EXTRACT(name, '$.{$locale}') = '".$name."'")
            ->where('type', $type)
            ->first();
    }
}
