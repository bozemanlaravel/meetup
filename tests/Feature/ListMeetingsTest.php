<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Meeting;

class ListMeetingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->signIn();

        $meeting = factory(Meeting::class)->create();

        $response = $this->get('/home');

        $response->assertSee($meeting->title);
    }
}
