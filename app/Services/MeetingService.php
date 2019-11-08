<?php

namespace App\Services;

use App\Meeting;

class MeetingService
{
    public function createMeeting($data, Int $organizer_id) {
        $meeting = Meeting::create(array_merge($data, ['organizer_id' => $organizer_id]));
        return $meeting ?: false;
    }

    public function deleteMeeting($meeting_id) {
        $meeting = Meeting::find($meeting_id);
        $meeting->delete();
        return $meeting;
    }
}
