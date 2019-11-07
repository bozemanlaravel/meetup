<?php

namespace Tests\Feature\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Meeting;
use App\Services\MeetingService;
use App\Traits\HasUserTests;

class MeetingServiceTest extends TestCase
{
    use HasUserTests;
    use RefreshDatabase;

    /** @test */
    public function can_delete_a_meeting() : void
    {
        $meeting = \factory(Meeting::class)->create();

        (new MeetingService)->deleteMeeting($meeting->id);

        $this->assertDatabaseMissing('meetings', ['id' => $meeting->id]);
    }
}
