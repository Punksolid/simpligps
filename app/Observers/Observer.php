<?php
/**
 * Created by PhpStorm.
 * User: ps
 * Date: 5/10/18
 * Time: 04:41 PM
 */

namespace App\Observers;


class UserObserver extends \Orchestra\Tenanti\Observer
{
    public function getDriverName()
    {
        return 'user';
    }
}