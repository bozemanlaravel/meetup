<?php

namespace App;

use App\Services\RoleService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed id
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin() : bool
    {
        return RoleService::getName($this->role_id) === 'administrator';
    }

    /**
     * @return HasManyThrough
     */
    public function meetings() : HasManyThrough
    {
        return $this->hasManyThrough(Meeting::class,MeetingUser::class,
            'meeting_id', 'id');
    }
}
