<?php

namespace App\Services;

use App\Meeting;

class MeetingService
{
    public function createMeeting($data, Int $organizer_id) {
        // Todo: Add and test form validation.
        $meeting = Meeting::create(array_merge($data, ['organizer_id' => $organizer_id]));

        return $meeting ?: false;
    }
}
