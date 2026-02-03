<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE_NAME = 'sipr_user_has_roles';
    private const ROLE_ID = "role_id";
    private const USER_ID = "user_id";
    private const TABLE_USER_ID = "id";
    private const TABLE_USER = "users";
    private const TABLE_ROLE_ID = "id";
    private const TABLE_ROLE = "sipr_roles";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            # code...
        } else {


            Schema::create(self::TABLE_NAME, function (Blueprint $table) {
                $table
                    ->id()
                    ->autoIncrement()
                    ->unsigned()
                    ->nullable(false);

                $table
                    ->bigInteger(self::USER_ID)
                    ->unsigned();

                $table
                    ->bigInteger(self::ROLE_ID)
                    ->unsigned();

                $table
                    ->foreign(self::USER_ID)
                    ->references(self::TABLE_USER_ID)
                    ->on(self::TABLE_USER)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table
                    ->foreign(self::ROLE_ID)
                    ->references(self::TABLE_ROLE_ID)
                    ->on(self::TABLE_ROLE)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->softDeletesDatetime();
                $table->datetimes(); // created_at & updated_at
                //     $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            // Jika ada, lakukan drop
            Schema::dropIfExists(self::TABLE_NAME);

            // Anda bisa menambahkan log atau pesan di sini jika diperlukan
            // Log::info("Tabel " . self::TABLE_NAME . " berhasil dihapus.");
        }
    }
};
