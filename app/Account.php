<?php

namespace App;

use App\Notifications\UserLinkedToAccountNotification;
use Carbon\Carbon;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
//use Hyn\Tenancy\Repositories\WebsiteRepository;
use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Traits\LogsActivity;

class Account extends \Hyn\Tenancy\Models\Website implements \Hyn\Tenancy\Contracts\Website
{
    use UsesSystemConnection, SoftDeletes, Notifiable, LogsActivity;

    protected $table = 'accounts'; // parece que esto hace que no tenga migraciones automaticas
    // protected $table = "websites"; // Con este funciona la creación vía WebsiteRepositoryContract
    // y su migración automatica, también parece funcionar mejor con las validaciones

    protected $fillable = [
        'easyname',
        'uuid',
        'bulk',
    ];

    protected $casts = [
        'bulk' => 'array',
    ];

    public function hostnames(): HasMany
    {
        // TODO: Implement hostnames() method.
        return null;
    }

    //region Relationships
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_accounts');
    }

    /**
     * An account has some licenses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function licenses()
    {
        return $this->belongsToMany(License::class, 'licenses_accounts')
            ->withPivot([
                'expires_at',
                'created_at',
            ]);
    }

    //endregion

    /**
     * Licencias por periodo activo basados en la fecha.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function activeLicenses()
    {
        $now = Carbon::now();

        return $this->belongsToMany(License::class, 'licenses_accounts')
            ->withPivot(['expires_at', 'created_at'])
            ->wherePivot('expires_at', '>=', $now);
    }

    // region Scopes
    public function scopeActive($query)
    {
        return $query->whereHas('activeLicenses');
    }

    public function scopeNearToExpire($query)
    {
        return $query->whereHas('nearToExpireLicenses');
    }

    // endregion
    public function nearToExpireLicenses($days = 7)
    {
        $now = Carbon::now();

        return $this->belongsToMany(License::class, 'licenses_accounts')->withPivot(['expires_at'])
            ->withPivot(['expires_at', 'created_at'])
            ->wherePivot('expires_at', '>=', $now->toDateTimeString())
            ->wherePivot('expires_at', '<=', $now->addDays($days)->toDateTimeString());
    }

    /**
     * Revisa si la cuenta tiene una licencia con periodo activo.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool) $this->activeLicenses()->first();
    }

    //region Actions
    public function createAccount()
    {
        app(WebsiteRepository::class)->create($this);
        config(['database.default' => 'system']);

        return $this;
    }

    public function addUser(User $user): bool
    {
        try {
            $this->users()->syncWithoutDetaching([$user->id]);
            $user->notify(new UserLinkedToAccountNotification($this));

            return true;
        } catch (\Exception $e) {
            info('Error in addUser');
            log($e);

            return false;
        }
    }

    /**
     * Detachs user from account.
     *
     * @param User $user
     *
     * @return bool
     */
    public function removeUser(User $user): bool
    {
        return (bool) $this->users()->detach($user->id);
    }

    /**
     * Adds license to an account.
     *
     * @param License $license
     * @param $pivots array atributos del pivote para modificar los originales
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function addLicense(License $license, array $pivots = []): bool
    {
        try {
            if (count($pivots)) {
                $v = \Validator::make($pivots, [
                    'expires_at' => 'required|date',
                ]);

                throw_if($v->fails(),
                    ValidationException::withMessages([
                            'error' => [
                                'Argumentos invalidos en los pivots',
                            ], ]
                    )
                );

                $this->licenses()->attach($license->id, $pivots);
            } else {
                $this->licenses()->attach($license->id, [
                    'expires_at' => Carbon::now()->addDays($license->lapse)->endOfDay()->toDateTimeString(),
                ]);
            }

            return true;
        } catch (\Exception $exception) {
            \Log::info($exception);
            throw $exception;
        }
    }

    //endregion

    //region Info
    public function getTenantData($model): Model
    {
        $environment = app(\Hyn\Tenancy\Environment::class);
        $environment->tenant($this);

        return new $model();
    }

    /**
     * Devuelve si la cuenta puede conectarse a su propia base de datos
     * util para revisar integridad de cuentas.
     *
     * @return bool
     */
    public function hasDatabaseAccesible(): bool
    {
        config(['database.connections.tenant.database' => $this->uuid]);
        try {
            $database_response = \DB::connection('tenant')->getPdo();
        } catch (\Exception $exception) {
            return false;
        }

        return (bool) $database_response;
    }

    /**
     * Checks if the given user exists or has access to the account.
     *
     * @param User $user
     *
     * @return bool
     */
    public function userExists(User $user): bool
    {
        return $this->whereHas('users', function ($query) use ($user) {
            $query->whereEmail($user->email);
        })->exists();
    }

    //endregion
}
