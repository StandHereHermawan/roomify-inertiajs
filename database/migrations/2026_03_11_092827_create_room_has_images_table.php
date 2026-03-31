<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const ID = "id";
    private const TABLE_NAME = 'sipr_room_has_images';
    private const IMAGE_ID = "image_id";
    private const ROOM_ID = "room_id";
    private const TABLE_ROOM_ID = "id";
    private const TABLE_ROOM = "sipr_rooms";
    private const TABLE_IMAGE_ID = "id";
    private const TABLE_IMAGE = "sipr_images";

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
                    ->bigInteger(self::IMAGE_ID)
                    ->unsigned();

                $table
                    ->bigInteger(self::ROOM_ID)
                    ->unsigned();

                $table
                    ->foreign(self::IMAGE_ID)
                    ->references(self::TABLE_IMAGE_ID)
                    ->on(self::TABLE_IMAGE)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table
                    ->foreign(self::ROOM_ID)
                    ->references(self::TABLE_ROOM_ID)
                    ->on(self::TABLE_ROOM)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->softDeletesDatetime();
                $table->datetimes(); // created_at & updated_at same as $table->timestamps();
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
