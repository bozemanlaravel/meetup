<?php

namespace App\Services;

use App\Meeting;

class MeetingService
{
    /**
     * @param array $data
     * @param Int $organizer_id
     * @return Meeting|null
     */
    public function createMeeting(array $data, int $organizer_id) : ?Meeting
    {
        // Todo: Add and test form validation.
        $meeting = Meeting::create(array_merge($data, ['organizer_id' => $organizer_id]));

        return $meeting;
    }

    /**
     * @param Int $meeting_id
     * @return int
     */
    public function deleteMeeting(int $meeting_id) : int
    {
        return Meeting::destroy($meeting_id);
    }

}
