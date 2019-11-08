<?php

namespace Tests\Feature;

use App\Meeting;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateMeetingsTest extends TestCase
{

    /** @test */
    public function the_route_to_create_meetings_is_not_visible_to_guests()
    {
        $this->assertTrue(auth()->guest());

        $this->get('/meetings/create')
            ->assertRedirect('/login');
    }

    /** @test */
    public function it_can_create_a_new_meeting()
    {
        $user = $this->signIn();

        $validFormData = factory(Meeting::class)->make(['organizer_id' => null])->toArray();

        $this->from('/home')->post('/meetings', $validFormData)->assertRedirect('/home');

        $this->assertDatabaseHas('meetings', [
            'organizer_id' => $user->id,
            'name' => $validFormData['name'],
            'description' => $validFormData['description'],
            'start' => $validFormData['start'],
            'end' => $validFormData['end'],
            'location_name' => $validFormData['location_name'],
            'location_address' => $validFormData['location_address'],
            'location_url' => $validFormData['location_url'],
        ]);
    }
}
