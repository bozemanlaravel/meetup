<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property mixed id
 */
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

    /**
     * @return HasManyThrough
     */
    public function attending_users() : HasManyThrough
    {
        return $this->hasManyThrough(User::class,MeetingUser::class,
            'user_id', 'id')->where('meeting_user.attending', True);
    }

    /**
     * @return HasManyThrough
     */
    public function declined_users() : HasManyThrough
    {
        return $this->hasManyThrough(User::class,MeetingUser::class,
            'user_id', 'id')->where('meeting_user.attending', False);
    }

}
