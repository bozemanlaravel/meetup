<?php

namespace Tests\Unit;

use App\Meeting;
use App\Services\MeetingUserService;
use App\Traits\HasUserTests;
use App\Traits\HasMeetingTests;
use App\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MeetingUserServiceTest extends TestCase
{
    use RefreshDatabase;
    use HasUserTests;
    use HasMeetingTests;

    /** @test */
    public function user_has_a_related_meeting()
    {
        $admin_user = $this->setup_admin_user();
        [$meeting_data, $meeting] = $this->make_meeting($admin_user);
        $meeting_user = $this->make_meeting_user($admin_user, $meeting);

        $user = User::with(['meetings'])->first();

        foreach (array_keys($meeting_data) as $key) {
            static::assertEquals($meeting_data[$key], $user->meetings->first()->$key);
        }
    }

    /** @test */
    public function meetings_have_user_relationship()
    {
        $admin_user = $this->setup_admin_user();
        [$meeting_data, $meeting] = $this->make_meeting($admin_user);
        $meeting_user = $this->make_meeting_user($admin_user, $meeting);

        $test_meeting = Meeting::with('users')->first();
        foreach (array_keys($admin_user->toArray()) as $key) {
            static::assertEquals($admin_user->$key, $test_meeting->users()->first()->$key);
        }
    }

    /** @test */
    public function user_can_attend_a_meeting()
    {
        $admin_user = $this->setup_admin_user();
        [$meeting_data, $meeting] = $this->make_meeting($admin_user);

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
        $admin_user = $this->setup_admin_user();
        [$meeting_data, $meeting] = $this->make_meeting($admin_user);
        $meeting_user = (new MeetingUserService)->addUserToMeeting($admin_user, $meeting, True);

        $user = Meeting::with('attending_users')->first();
        static::assertEquals($admin_user->id, $user->id);
    }

    /** @test */
    public function meetings_have_declined_users()
    {
        $admin_user = $this->setup_admin_user();
        [$meeting_data, $meeting] = $this->make_meeting($admin_user);
        $meeting_user = (new MeetingUserService)->addUserToMeeting($admin_user, $meeting, False);

        $user = Meeting::with('declined_users')->first();
        static::assertEquals($admin_user->id, $user->id);
    }

}
