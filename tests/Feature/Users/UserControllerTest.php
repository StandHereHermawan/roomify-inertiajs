<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_user_page_screen_redirect_if_not_yet_login(): void
    {
        $response = $this->get(route('user.page'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
        
        $this->assertGuest();
    }

    public function test_user_page_is_displayed()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('user.page'));

        $response->assertOk();
    }
}
