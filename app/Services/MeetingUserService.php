<?php
/**
 * Created by PhpStorm.
 * User: glema
 * Date: 10/3/2019
 * Time: 11:07 AM
 */

namespace App\Services;
use App\MeetingUser;
use App\Services\ReminderService;
use App\Meeting;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class MeetingUserService
{
    /**
     * @param User $user
     * @param Meeting $meeting
     * @param bool $attending
     * @return MeetingUser
     */
    final public function addUserToMeeting(User $user, Meeting $meeting, bool $attending) : MeetingUser
    {
        $meeting_user = MeetingUser::create([
            'user_id' => $user->id,
            'meeting_id' => $meeting->id,
            'attending' => $attending
        ]);

        if ($meeting_user->attending == true) {
            (new ReminderService)->createReminders($meeting_user);
        } else {
            (new ReminderService)->removeReminders($meeting_user);
        }

        return $meeting_user;
    }

    /**
     * @param User $user
     * @param Meeting $meeting
     * @param bool $attending
     * @return MeetingUser
     */
    final public function changeAttendanceOfMeeting(User $user, Meeting $meeting, bool $attending) : MeetingUser
    {
        $meeting_user = MeetingUser::where([
            'user_id' => $user->id,
            'meeting_id' => $meeting->id
            ])->first();

        if ($meeting_user === null){
            return MeetingUser::create([
                'user_id' => $user->id,
                'meeting_id' => $meeting->id,
                'attending' => $attending
            ]);
        }

        $meeting_user->attending = $attending;
        $meeting_user->save();

        if ($meeting_user->attending == true) {
            (new ReminderService)->createReminders($meeting_user);
        } else {
            (new ReminderService)->removeReminders($meeting_user);
        }

        return $meeting_user;
    }

    /**
     * @param Meeting $meeting
     * @return Builder
     */
    final public function getAllAttendees(Meeting $meeting) : Builder
    {
        return Meeting::find($meeting->id)->with(['attending_users']);
    }

    /**
     * @param Meeting $meeting
     * @return Builder
     */
    final public function getAllDeclined(Meeting $meeting) : Builder
    {
        return Meeting::find($meeting->id)->with(['declined_users']);
    }

}
