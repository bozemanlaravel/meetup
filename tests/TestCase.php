<?php

namespace Tests;

use App\User;
use App\Services\RoleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\CreateMeetingsTest;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected function signIn($role = 'user')
    {
        $roleId = RoleService::getId($role);

        $user = factory(User::class)->create(['role_id' => $roleId]);

        $this->actingAs($user);

        return $user;
    }
}
