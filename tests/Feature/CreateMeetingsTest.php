<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateMeetingsTest extends TestCase
{
    /** @test */
    public function the_route_to_create_meetings_is_not_visible_to_guests()
    {
        $this->assertTrue(auth()->guest());

        $this->get('/meetings/create')->assertStatus(302);
    }

    /** @test */
    public function it_can_create_a_new_meeting()
    {
        $user = $this->signIn();

        $validForm = [
            'organizer_id' => $user->id,
            'name' => 'test name',
            'description' => 'test description',
            'start' => now(),
            'end' => now()->addHour(),
            'location_name' => 'test location name',
            'location_address' => 'test address',
            'location_url' => 'test url',
        ];

        $this->post('/meetings', $validForm);

        $this->assertDatabaseHas('meetings', $validForm);

    }

    protected function signIn()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        return $user;
    }
}
