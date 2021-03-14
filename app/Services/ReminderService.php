<?php

namespace App\Services;

use App\MeetingUser;
use App\Reminder;
use Carbon\CarbonImmutable;

class ReminderService
{
    public function createReminders(MeetingUser $meetingUser) {
        $start = CarbonImmutable::createFromFormat('Y-m-d H:i:s', $meetingUser->meeting->start);

        Reminder::create(
            [
                'send_time' => $start->subtract(1, 'week'),
                'meeting_user_id' => $meetingUser->id
            ]
        );

        Reminder::create(
            [
                'send_time' => $start->subtract(1, 'day'),
                'meeting_user_id' => $meetingUser->id
            ]
        );

        Reminder::create(
            [
                'send_time' => $start->subtract(1, 'hour'),
                'meeting_user_id' => $meetingUser->id
            ]
        );
    }

    public function removeReminders(MeetingUser $meetingUser) {
        $reminderIds = $meetingUser->reminders->pluck('id')->toArray();

        Reminder::destroy($reminderIds);
    }
}
