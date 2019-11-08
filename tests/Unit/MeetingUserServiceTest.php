<?php

namespace Tests\Unit;

use App\Meeting;
use App\Services\MeetingUserService;
use App\Traits\HasUserTests;
use App\Traits\HasMeetingTests;
use App\User;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MeetingUserServiceTest extends TestCase
{
    use HasUserTests;
    use HasMeetingTests;

    /** @test */
    public function user_has_a_related_meeting()
    {
        $admin_user = $this->setupAdminUser();
        [$meeting_data, $meeting] = $this->makeMeeting($admin_user);
        $meeting_user = $this->makeMeetingUser($admin_user, $meeting);

        $user = User::with(['meetings'])->first();

        foreach (array_keys($meeting_data) as $key) {
            static::assertEquals($meeting_data[$key], $user->meetings->first()->$key);
        }
    }

    /** @test */
    public function meetings_have_user_relationship()
    {
        $admin_user = $this->setupAdminUser();
        [$meeting_data, $meeting] = $this->makeMeeting($admin_user);
        $meeting_user = $this->makeMeetingUser($admin_user, $meeting);

        $test_meeting = Meeting::with('users')->first();
        foreach (array_keys($admin_user->toArray()) as $key) {
            static::assertEquals($admin_user->$key, $test_meeting->users()->first()->$key);
        }
    }

    /** @test */
    public function user_can_attend_a_meeting()
    {
        $admin_user = $this->setupAdminUser();
        [$meeting_data, $meeting] = $this->makeMeeting($admin_user);

        $meeting_user = (new MeetingUserService)->addUserToMeeting($admin_user, $meeting, True);

        static::assertEquals($meeting_user->user_id, $admin_user->id);
        static::assertEquals($meeting_user->meeting_id, $meeting->id);
        static::assertEquals($meeting_user->attending, True);

        $meeting_user = (new MeetingUserService)->addUserToMeeting($admin_user, $meeting, False);

        static::assertEquals($meeting_user->user_id, $admin_user->id);
        static::assertEquals($meeting_user->meeting_id, $meeting->id);
        static::assertEquals($meeting_user->attending, False);
    }

    /** @test */
    public function meetings_have_attending_users()
    {
        $admin_user = $this->setupAdminUser();
        [$meeting_data, $meeting] = $this->makeMeeting($admin_user);
        $meeting_user = (new MeetingUserService)->addUserToMeeting($admin_user, $meeting, True);

        $user = Meeting::with('attending_users')->first();
        static::assertEquals($admin_user->id, $user->id);
    }

    /** @test */
    public function meetings_have_declined_users()
    {
        $admin_user = $this->setupAdminUser();
        [$meeting_data, $meeting] = $this->makeMeeting($admin_user);
        $meeting_user = (new MeetingUserService)->addUserToMeeting($admin_user, $meeting, False);

        $user = Meeting::with('declined_users')->first();
        static::assertEquals($admin_user->id, $user->id);
    }

    /** @test */
    public function get_all_attending_users()
    {
        $admin_user = $this->setupAdminUser();
        [$meeting_data, $meeting] = $this->makeMeeting($admin_user);
        $meeting_user = (new MeetingUserService)->addUserToMeeting($admin_user, $meeting, True);

        $attending_users = (new MeetingUserService)->getAllAttendees($meeting);

        static::assertEquals($admin_user->id, $attending_users->first()->id);
    }

    /** @test */
    public function get_all_declined_users()
    {
        $admin_user = $this->setupAdminUser();
        [$meeting_data, $meeting] = $this->makeMeeting($admin_user);
        $meeting_user = (new MeetingUserService)->addUserToMeeting($admin_user, $meeting, False);

        $declined_users = (new MeetingUserService)->getAllDeclined($meeting);

        static::assertEquals($admin_user->id, $declined_users->first()->id);
    }

    /** @test */
    public function user_can_decline_a_previously_attending_meeting()
    {
        $admin_user = $this->setupAdminUser();
        [$meeting_data, $meeting] = $this->makeMeeting($admin_user);
        (new MeetingUserService)->addUserToMeeting($admin_user, $meeting, True);

        $meeting_user = (new MeetingUserService)->changeAttendanceOfMeeting($admin_user, $meeting, False);

        static::assertFalse($meeting_user->attending);
        $meeting_user->delete();

        $meeting_user = (new MeetingUserService)->changeAttendanceOfMeeting($admin_user, $meeting, False);
        static::assertFalse($meeting_user->attending);
    }

    /** @test */
    public function user_can_decline_a_meeting_not_yet_accepted()
    {
        $admin_user = $this->setupAdminUser();
        [$meeting_data, $meeting] = $this->makeMeeting($admin_user);

        $meeting_user = (new MeetingUserService)->changeAttendanceOfMeeting($admin_user, $meeting, False);

        static::assertFalse($meeting_user->attending);
    }
}
