<?php
/**
 * Created by PhpStorm.
 * User: glema
 * Date: 10/3/2019
 * Time: 11:07 AM
 */

namespace App\Services;
use App\MeetingUser;
use App\Meeting;
use App\User;

class MeetingUserService
{
    public function addUserToMeeting(User $user, Meeting $meeting, bool $attending) : MeetingUser
    {
        $meeting_user = MeetingUser::create([
            'user_id' => $user->id,
            'meeting_id' => $meeting->id,
            'attending' => $attending
        ]);

        return $meeting_user;
    }
}