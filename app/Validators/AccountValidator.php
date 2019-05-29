<?php

/*
 * This file is part of the hyn/multi-tenant package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://laravel-tenancy.com
 * @see https://github.com/hyn/multi-tenant
 */

namespace App\Validators;

use Hyn\Tenancy\Validators\WebsiteValidator;

class AccountValidator extends WebsiteValidator
{
    protected $create = [
        'uuid' => ['required', 'string', 'unique:%system%.accounts,uuid'],
    ];
    protected $update = [
        'uuid' => ['required', 'string', 'unique:%system%.accounts,uuid,%id%'],
    ];
}
