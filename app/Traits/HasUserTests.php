<?php
/**
 * Created by PhpStorm.
 * User: glema
 * Date: 10/3/2019
 * Time: 1:05 PM
 */

namespace App\Traits;
use Illuminate\Support\Facades\Artisan;
use App\User;
use App\Meeting;
use App\MeetingUser;

trait HasUserTests
{
    /**
     * @return mixed
     */
    public function setup_admin_user()
    {
        Artisan::call('db:seed');
        return User::whereEmail('admin@example.com')->first();
    }



}