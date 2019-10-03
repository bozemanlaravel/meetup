<?php

use App\User;
use App\Services\RoleService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $configAdmin = config('meetup.admin');

        if (! User::whereEmail($configAdmin['email'])->first()) {

            User::create(array_merge($configAdmin, [
                    'password' => Hash::make($configAdmin['password']),
                    'role_id' => RoleService::getId('administrator')
                ]
            ));
        }
    }
}
