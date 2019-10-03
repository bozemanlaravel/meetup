<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Meeting extends Model
{
    protected $guarded = [];

    /**
     * @return HasManyThrough
     */
    public function users() : HasManyThrough
    {
        return $this->hasManyThrough(User::class,MeetingUser::class,
            'user_id', 'id');
    }
}
