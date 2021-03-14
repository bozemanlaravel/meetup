<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Traits\HasMeetingTests;
use App\Traits\HasUserTests;
use App\Services\ReminderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\MeetingUser;

class ReminderServiceTest extends TestCase
{
    use RefreshDatabase;
    use HasUserTests;
    use HasMeetingTests;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_reminders_are_added_to_meeting_user()
    {
        $meeting_user = factory(MeetingUser::class)->create();

        (new ReminderService)->createReminders($meeting_user);

        $this->assertDatabaseCount('reminders', 3);
    }

    public function test_reminders_are_from_meeting_user_when_declining_event()
    {
        $meeting_user = factory(MeetingUser::class)->create();

        (new ReminderService)->createReminders($meeting_user);
        $this->assertDatabaseCount('reminders', 3);

        // Remove reminders
        (new ReminderService)->removeReminders($meeting_user);
        $this->assertDatabaseCount('reminders', 0);
    }
}
