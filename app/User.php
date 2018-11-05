<?php

namespace App;

use App\Observers\UserObserver;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Orchestra\Tenanti\Contracts\TenantProvider;
use Orchestra\Tenanti\Tenantor;
use Spatie\Permission\Traits\HasRoles;

//class User extends Authenticatable implements TenantProvider
class User extends Authenticatable
{
    use HasRoles, Notifiable, HasApiTokens;

    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    public function asTenantor(): Tenantor
//    {
//        return Tenantor::fromEloquent('user',$this);
//        // TODO: Implement asTenantor() method.
//    }
//    /**
//     * Make a tenantor.
//     *
//     * @return \Orchestra\Tenanti\Tenantor
//     */
//    public static function makeTenantor($key, $connection = null): Tenantor
//    {
//        return Tenantor::make(
//            'user', $key, $connection ?: (new static())->getConnectionName()
//        );
//    }
//
//    /**
//     * The "booting" method of the model.
//     */
//    protected static function boot()
//    {
//        parent::boot();
//
//        static::observe(new UserObserver());
//    }


    public function profile()
    {
        return $this->hasOne(Profile::class, "user_id")
            ->withDefault([
                "name" => "default",
                "lastname" => "default",
                "username" => "defaultx"
            ]);
    }

    /**
     * A user can have many accounts
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function accounts()
    {
        return $this->belongsToMany(Account::class, "users_accounts");
    }

    public function attachAccount(Account $account): bool
    {
        try {
            $this->accounts()->attach($account->id);
            return true;
        } catch (\Exception $exception) {
            \Log::info($exception);
            throw $exception;
        }
    }

    /**
     * Obtiene todos los usuarios de una cuenta o de todas las cuentas del usuario
     * @param Account|null $account
     * @return Collection
     */
    public function getColleagues(Account $account = null, $me_too = false): Collection
    {
        $user = $this;
        if (is_null($account)) {
            $colleagues = User::whereHas('accounts', function ($account_query) use ($user) {
                $account_query->whereHas('users', function ($users_query) use ($user) {
                    $users_query->find($user);
                });
            })->get();
        } else {
            $colleagues = $this->accounts()->findOrFail($account->id)->users()->get();
        }

        if ($me_too) {
            return $colleagues;
        }

        $colleagues = $colleagues->filter(function ($colleague) use ($user) {
            return $colleague->email != $user->email;
        });

        return $colleagues;
    }
}
