<?php

namespace App\Models;

use App\Traits\Attributes\HasIdentifier;
use App\Traits\HasBasicAudit;
use App\Traits\Relation\HasRelationWithUserModel;
use Illuminate\Database\Eloquent\Model;

class RoomReservation extends Model
{
    /**
     * @use HasBasicAudit<\App\Traits\HasBasicAudit> 
     * @use HasIdentifier<\App\Traits\Attributes\HasIdentifier> 
     * @use HasRelationWithUserModel<\App\Traits\Relation\HasRelationWithUserModel> 
     */
    use HasIdentifier,
        HasRelationWithUserModel,
        HasBasicAudit
    ;

    public const TABLE_NAME = "sipr_room_reservations";
    public const ROOM_ID = "room_id";
    public const ROOM_CODE = "room_code";
    public const STATUS = "status";
    public const DETERMINED_AT = "determined_at";
    public const RESERVATION_DATE = "reservation_date";

    protected $table = self::TABLE_NAME;
    protected $primaryKey = self::ID;
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        self::ROOM_ID,
        self::RESERVATION_DATE,
        self::DETERMINED_AT,
        self::STATUS,
        self::ID,
        self::USER_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    public function room()
    {
        // Satu comment dimiliki oleh satu post
        return $this->belongsTo(Room::class);
    }

    public function roomSessions()
    {
        return $this->belongsToMany(
            RoomSession::class,                // Model tujuan
            RoomSessionReservation::TABLE_NAME,     // Nama tabel pivot
            RoomSessionReservation::ROOM_RESERVATION_ID,                 // Foreign key di tabel pivot untuk User
            RoomSessionReservation::ROOM_SESSION_ID                  // Foreign key di tabel pivot untuk Role
        )
            ->withPivot(RoomSessionReservation::CREATED_AT)      // Mengambil kolom created_at dari tabel pivot
            ->withTimestamps();            // Memastikan pivot timestamps ditangani otomatis
    }
}
