<?php

namespace App;

use App\Notifications\UserLinkedToAccountNotification;
use Carbon\Carbon;
use DB;
use Exception;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Contracts\Website;
use Hyn\Tenancy\Environment;
use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Traits\LogsActivity;
use Validator;

class Account extends \Hyn\Tenancy\Models\Website implements Website
{
    use UsesSystemConnection;
    use SoftDeletes;
    use Notifiable;
    use LogsActivity;

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

    }

    //region Relationships

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_accounts');
    }

    /**
     * @param int $days
     *
     * @return BelongsToMany
     */
    public function nearToExpireLicenses($days = 7)
    {
        $now = Carbon::now();

        return $this->belongsToMany(License::class, 'licenses_accounts')->withPivot(['expires_at'])
            ->withPivot(['expires_at', 'created_at'])
            ->wherePivot('expires_at', '>=', $now->toDateTimeString())
            ->wherePivot('expires_at', '<=', $now->addDays($days)->toDateTimeString());
    }

    //endregion

    //region Scopes

    public function scopeNearToExpire($query)
    {
        return $query->whereHas('nearToExpireLicenses');
    }

    public function scopeActive($query)
    {
        return $query->whereHas('activeLicenses');
    }

    /**
     * Licencias por periodo activo basados en la fecha.
     *
     * @return BelongsToMany
     */
    public function activeLicenses()
    {
        $now = Carbon::now();

        return $this->belongsToMany(License::class, 'licenses_accounts')
            ->withPivot(['expires_at', 'created_at'])
            ->wherePivot('expires_at', '>=', $now);
    }

    //endregion

    //region Actions

    /**
     * Deletes everything, this is a NOT RECOVERY ACTION.
     *
     * @throws Exception
     */
    public function deleteWithDatabase()
    {
        \Artisan::call('trm:delete_account', [
            'uuid' => $this->uuid,
        ]);
        $this->delete();
    }

    public function addUser(User $user): bool
    {
        try {
            $this->users()->syncWithoutDetaching([$user->id]);
            $user->notify(new UserLinkedToAccountNotification($this));

            return true;
        } catch (Exception $exception) {
            info('Error in addUser', [$exception]);

            return false;
        }
    }

    public function createAccount()
    {
        app(WebsiteRepository::class)->create($this);
        config(['database.default' => 'system']);

        return $this;
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
     * @throws Exception
     */
    public function addLicense(License $license, array $pivots = []): bool
    {
        try {
            if (count($pivots)) {
                $validator = Validator::make(
                    $pivots,
                    [
                        'expires_at' => 'required|date',
                    ]
                );

                throw_if(
                    $validator->fails(),
                    ValidationException::withMessages(
                        [
                            'error' => [
                                'Argumentos invalidos en los pivots',
                            ],
                        ]
                    )
                );

                $this->licenses()->attach($license->id, $pivots);
            } else {
                $this->licenses()->attach(
                    $license->id,
                    [
                        'expires_at' => Carbon::now()->addDays($license->lapse)->endOfDay()->toDateTimeString(),
                    ]
                );
            }

            return true;
        } catch (Exception $exception) {
            \Log::info($exception);
            throw $exception;
        }
    }

    /**
     * An account has some licenses.
     *
     * @return BelongsToMany
     */
    public function licenses()
    {
        return $this->belongsToMany(License::class, 'licenses_accounts')
            ->withPivot(
                [
                    'expires_at',
                    'created_at',
                ]
            );
    }

    //endregion

    //region Info

    /**
     * Revisa si la cuenta tiene una licencia con periodo activo.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool) $this->activeLicenses()->first();
    }

    public function getTenantData($model): Model
    {
        $environment = app(Environment::class);
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
            return DB::connection('tenant')->getDatabaseName() === $this->uuid;
        } catch (Exception $exception) {
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
        return $this->whereHas(
            'users',
            function ($query) use ($user) {
                $query->whereEmail($user->email);
            }
        )->exists();
    }

    //endregion
}
