<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $fillable = [
        "name",
        "description",
        "lapse",
        "modules",
        "units",
        "number_active_sessions",
        "uuid"
    ];



    public function accounts()
    {
        return $this->belongsToMany(Account::class,"licenses_accounts");
    }

    public function assignToAccount(Account $account):bool
    {
        try {

            $this->accounts()->attach($account,["expires_at" => Carbon::now()->addDays($this->lapse)]);
            return true;
        } catch (\Exception $exception){
            return false;
        }
    }
}
