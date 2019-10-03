<?php
/**
 * Created by PhpStorm.
 * User: glema
 * Date: 10/3/2019
 * Time: 1:09 PM
 */

namespace App\Traits;
use App\MeetingUser;
use App\User;
use App\Meeting;

trait HasMeetingTests
{
    /**
     * @param User $organizer_user
     * @return array
     */
    public function make_meeting(User $organizer_user): array
    {
        $meeting_data = factory(Meeting::class)->make(['organizer_id' => $organizer_user->id])->toArray();
        $meeting = Meeting::create($meeting_data);
        return array($meeting_data, $meeting);
    }

    /**
     * @param User $user
     * @param Meeting $meeting
     * @return MeetingUser
     */
    public function make_meeting_user(User $user, Meeting $meeting): MeetingUser
    {
        $meeting_user = MeetingUser::create([
            'user_id' => $user->id,
            'meeting_id' => $meeting->id,
            'attending' => True
        ]);
        return $meeting_user;
    }

}