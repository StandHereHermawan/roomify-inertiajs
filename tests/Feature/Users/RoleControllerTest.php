<?php

namespace Tests\Feature\Users;

use App\Enums\EnumsRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        var_dump(EnumsRole::SUPER_ADMIN->value);
        $this->assertEquals('SUPER_ADMIN', EnumsRole::SUPER_ADMIN->value);
    }
}
