<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        "easyname",
        "uuid",
        "bulk"
    ];

    protected $casts = [
        "bulk" => "array"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, "users_accounts");
    }

    /**
     * An account has some licenses
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function licenses()
    {
        return $this->belongsToMany(License::class, "licenses_accounts")
            ->withPivot([
                "expires_at"
            ]);
    }

    /**
     * Adds license to an account
     * @param License $license
     * @return bool
     * @throws \Exception
     */
    public function addLicense(License $license):bool
    {
        try {
            $this->licenses()->attach($license->id,["expires_at" => Carbon::now()->addDays($license->lapse)->endOfDay()]);
            return true;
        } catch (\Exception $exception) {
            \Log::info($exception);
            throw $exception;
        }
    }

    public function activeLicenses()
    {
        $now = Carbon::now();
        return $this->belongsToMany(License::class, "licenses_accounts")
            ->wherePivot('expires_at', ">=", $now);
    }

    public function scopeActive($query)
    {
        return $query->whereHas("activeLicenses");


    }
}
