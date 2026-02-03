<?php

namespace Tests\Feature\Rooms;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomSessionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_room_session_page_screen_redirect_if_not_yet_login(): void
    {
        $response = $this->get(route('room.session.page'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
        
        $this->assertGuest();
    }

    public function test_room_session_page_is_displayed()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('room.session.page'));

        $response->assertOk();
    }
}
