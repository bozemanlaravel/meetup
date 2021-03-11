<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Meeting;

class AttendMeetingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_logged_in_user_can_attend_meeting()
    {
        $user = $this->signIn();
        $meeting = factory(Meeting::class)->create();
        $home_response = $this->get('/home');
        $home_response->assertSee('Attend');

        $attend_response = $this->from('/home')->post('/meetings/'.$meeting->id.'/attend');
        $this->get('/home')->assertSee('Going!');
    }
}
