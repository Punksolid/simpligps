<?php

namespace Tests\Unit;

use App\Account;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_have_many_accounts()
    {
        $user = factory(User::class)->create();
        $account = factory(Account::class)->create();
        $account2 = factory(Account::class)->create();

        $account->addUser($user);
        $account2->addUser($user);


        $this->assertEquals($user->email, $account->users()->first()->email);
        $this->assertEquals(2, $user->accounts()->count());
    }

    public function test_see_my_coleages()
    {
        $me = factory(User::class)->create();
        $account = factory(Account::class)->create();
        $colleague = factory(User::class)->create();

        $account->addUser($me);
        $account->addUser($colleague);

        $colleagues = $me->getColleagues($account);

        $this->assertEquals(1, $colleagues->count());
        $this->assertEquals($colleague->name, $colleagues->first()->name);
    }

    public function test_tenant_database_existence()
    {
        $account = factory(Account::class)->make();

        $account->createAccount();

        $this->assertTrue($account->hasDatabaseAccesible());
    }

    public function test_tenant_doesnt_have_database()
    {
        $account = factory(Account::class)->create();

        $this->assertFalse($account->hasDatabaseAccesible());

    }

}
