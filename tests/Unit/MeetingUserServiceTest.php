<?php

namespace Tests\Unit;

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


}
