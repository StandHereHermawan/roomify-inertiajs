<?php

namespace Tests;

use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        $env = Env::get('DB_CONNECTION');
        $env_sqlite = $env === 'sqlite';

        parent::setUp();
        $this->setUpTheTestEnvironment();

        DB::delete("DELETE FROM " . Room::TABLE_NAME);
        DB::delete("DELETE FROM " . User::TABLE_NAME);

        if ($env_sqlite) {
            DB::statement("UPDATE sqlite_sequence SET seq = 0 WHERE name='" . Room::TABLE_NAME . "'");
            DB::statement("UPDATE sqlite_sequence SET seq = 0 WHERE name='" . User::TABLE_NAME . "'");
        } else {
            DB::statement("ALTER TABLE " . Room::TABLE_NAME . " AUTO_INCREMENT = 1");
            DB::statement("ALTER TABLE " . User::TABLE_NAME . " AUTO_INCREMENT = 1");
        }

        User::factory()->terryandrewdavis()->create();
    }
}
