<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return HasManyThrough
     */
    public function attending_users() : BelongsToMany
    {
        return $this->belongsToMany(User::class)->where('meeting_user.attending', True);
    }

    /**
     * @return HasManyThrough
     */
    public function declined_users() : BelongsToMany
    {
        return $this->belongsToMany(User::class)->where('meeting_user.attending', False);
    }

}
