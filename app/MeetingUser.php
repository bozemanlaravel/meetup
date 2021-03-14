<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\User;
use App\Meeting;
use App\Reminder;

class MeetingUser extends Pivot
{
    protected $guarded = [];
    public $incrementing = true;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function meeting() {
        return $this->belongsTo(Meeting::class);
    }

    public function reminders() {
        return $this->hasMany(Reminder::class, 'meeting_user_id');
    }
}
