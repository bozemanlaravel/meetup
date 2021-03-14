<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\MeetingUser;
use Illuminate\Notifications\Notifiable;

class Reminder extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return config('notifications.slack_webhook');
    }

    public function meetingUser() {
        return $this->belongsTo(MeetingUser::class);
    }
}
