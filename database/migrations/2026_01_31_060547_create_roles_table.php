<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE_NAME = 'sipr_roles';
    private const NAME = 'role';
    private const CREATED_AT = "created_at";
    private const UPDATED_AT = "updated_at";
    // private const DELETED_AT = "deleted_at";

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
                    ->string(self::NAME, 30)
                    ->unique();

                $table
                    ->softDeletesDatetime();

                $table
                    ->dateTime(self::CREATED_AT)
                    ->nullable(true)
                    ->useCurrent();

                $table
                    ->dateTime(self::UPDATED_AT)
                    ->nullable(true)
                    ->useCurrent()
                    ->useCurrentOnUpdate();
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
