<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Str;

/**
 * @property mixed id
 */
class Meeting extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Meeting $meeting) {
            $meeting->uuid = (string)Str::uuid();
        });
    }

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
