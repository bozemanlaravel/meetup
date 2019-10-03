<?php

namespace App\Providers;

use App\User;
use App\Services\RoleService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $configAdmin = config('meetup.admin');

        if (! User::whereEmail($configAdmin['email'])->first()) {
            $configAdmin['password'] = Hash::make($configAdmin['password']);

            User::create(array_merge($configAdmin, [
                'role_id' => RoleService::getId('administrator')]
            ));
        }
    }
}
