<?php

use App\Domains\Schedule\Model\SiprRoomSessionReservationRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const ID = "id";
    private const CREATED_AT = "created_at";
    private const UPDATED_AT = "updated_at";
    private const DELETED_AT = "deleted_at";
    private const TABLE_NAME = "sipr_room_session_reservations";
    
    private const TABLE_ROOM_RESERVATION = "sipr_room_reservations";
    private const TABLE_ROOM_RESERVATION_COLUMN_ID = "id";
    private const TABLE_USER_COLUMN_ID = "id";
    private const USER_ID = "user_id";
    private const TABLE_ROOM_SESSION = 'sipr_room_sessions';
    private const TABLE_ROOM_SESSION_COLUMN_ID = 'id';
    private const ROOM_RESERVATION_ID = "room_reservation_id";
    private const ROOM_SESSION_ID = "room_session_id";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table
                ->id(self::ID)
                ->autoIncrement()
                ->unsigned()
                ->nullable(false);

            $table->unsignedBigInteger(self::ROOM_SESSION_ID)->nullable();
            $table->unsignedBigInteger(self::ROOM_RESERVATION_ID)->nullable();

            $table
                ->foreign(self::ROOM_RESERVATION_ID)
                ->references(self::TABLE_ROOM_RESERVATION_COLUMN_ID)
                ->on(self::TABLE_ROOM_RESERVATION)
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table
                ->foreign(self::ROOM_SESSION_ID)
                ->references(self::TABLE_ROOM_SESSION_COLUMN_ID)
                ->on(self::TABLE_ROOM_SESSION)
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

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

        (new \Database\Seeders\DatabaseSeeder)->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
