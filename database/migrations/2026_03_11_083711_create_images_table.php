<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const ID = "id";
    private const TABLE_NAME = 'sipr_images';
    private const NAME = 'name';
    private const DESCRIPTION = 'description';
    private const BINARY = 'binary';
    private const CREATED_AT = "created_at";
    private const UPDATED_AT = "updated_at";

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
                    ->id(self::ID)
                    ->autoIncrement()
                    ->unsigned()
                    ->nullable(false);

                $table
                    ->binary(self::BINARY)
                    ->nullable();

                $table
                    ->string(self::NAME, 255)
                    ->nullable()
                    ->default('Belum Ada Nama.');

                $table
                    ->longText(self::DESCRIPTION)
                    ->nullable()
                    ->default(null);

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
            Log::info("Tabel " . self::TABLE_NAME . " berhasil dihapus.");
        }
    }
};
