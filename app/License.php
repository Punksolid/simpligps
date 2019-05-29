<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $fillable = [
        'name',
        'description',
        'lapse',
        'modules',
        'units',
        'number_active_sessions',
        'uuid',
    ];

    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'licenses_accounts')
            ->withPivot(['expires_at', 'created_at']);
    }

    public function assignToAccount(Account $account): bool
    {
        try {
            $this->accounts()->attach($account, ['expires_at' => Carbon::now()->addDays($this->lapse)]);

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function revoke(Account $account): bool
    {
        try {
            $this->accounts()->detach($account->id);

            return true;
        } catch (\Exception $exception) {
            logger($exception);

            return false;
        }
    }

    /**
     * Devuelve si una licencia tiene alguna relación existente.
     *
     * @return bool
     */
    public function hasAnyRelationship(): bool
    {
        if ($this->accounts()->exists()) {
            return true;
        }

        return false;
    }
}
