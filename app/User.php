<?php

namespace App;

use App\Notifications\PasswordResetRequest;
use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements CanResetPassword
{
    use HasRoles, Notifiable, HasApiTokens, UsesSystemConnection;

    protected $guard_name = 'api'; // changed from web to api bcz permissions sync using default
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

    public function profile()
    {
        return $this->hasOne(Profile::class, "user_id")
            ->withDefault([
                "name" => "",
                "lastname" => "",
                "username" => ""
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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetRequest($token));
    }


    public function isInAccount(int $account_id):bool
    {
        return (bool)$this->accounts()->whereHas('users', function ($users_query) use($account_id){
            $users_query->where('account_id',$account_id);
        })->exists();
    }
}
