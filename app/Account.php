<?php

namespace App;

use Carbon\Carbon;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
//use Hyn\Tenancy\Repositories\WebsiteRepository;
use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\ValidationException;

class Account extends \Hyn\Tenancy\Models\Website implements \Hyn\Tenancy\Contracts\Website
{
    use UsesSystemConnection, SoftDeletes;

    protected $table = "accounts"; // parece que esto hace que no tenga migraciones automaticas
//    protected $table = "websites"; // Con este funciona la creación vía WebsiteRepositoryContract
    // y su migración automatica, también parece funcionar mejor con las validaciones

    protected $fillable = [
        "easyname",
        "uuid",
        "bulk"
    ];

    protected $casts = [
        "bulk" => "array"
    ];

    public function hostnames(): HasMany
    {
        // TODO: Implement hostnames() method.
        return null;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "users_accounts");
    }

    public function addUser(User $user): bool
    {
        try {
            $this->users()->attach($user->id);
            return true;
        } catch (\Exception $e) {
            info("Error en addUser");
            log($e);
            return false;
        }

    }

    /**
     * An account has some licenses
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function licenses()
    {
        return $this->belongsToMany(License::class, "licenses_accounts")
            ->withPivot([
                "expires_at",
                "created_at"
            ]);
    }

    /**
     * Adds license to an account
     * @param License $license
     * @param $pivots array atributos del pivote para modificar los originales
     * @return bool
     * @throws \Exception
     */
    public function addLicense(License $license, array $pivots = []): bool
    {
        try {
            if (!empty($pivots)) {
                $v = \Validator::make($pivots, [
                    "expires_at" => "required|date"
                ]);

                throw_if($v->fails(),
                    ValidationException::withMessages([
                            "error" => [
                                "Argumentos invalidos en los pivots"
                            ]]
                    )
                );

                $this->licenses()->attach($license->id, $pivots);
            } else {
                $this->licenses()->attach($license->id, [
                    "expires_at" => Carbon::now()->addDays($license->lapse)->endOfDay()->toDateTimeString()
                ]);
            }

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
            ->withPivot(["expires_at", "created_at"])
            ->wherePivot('expires_at', ">=", $now);
    }

    public function scopeActive($query)
    {
        return $query->whereHas("activeLicenses");

    }

    public function nearToExpireLicenses($days = 7)
    {
        $now = Carbon::now();
        return $this->belongsToMany(License::class, "licenses_accounts")->withPivot(["expires_at"])
            ->withPivot(["expires_at", "created_at"])
            ->wherePivot('expires_at', ">=", $now->toDateTimeString())
            ->wherePivot("expires_at", "<=", $now->addDays($days)->toDateTimeString());

    }

    public function scopeNearToExpire($query)
    {
        return $query->whereHas("nearToExpireLicenses");
    }

    /**
     * Revisa si la cuenta tiene una licencia con periodo activo
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool)$this->activeLicenses()->first();
    }

    public function createAccount()
    {
        app(WebsiteRepository::class)->create($this);
        
        return $this;

    }
}
