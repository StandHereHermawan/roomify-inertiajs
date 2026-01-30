<?php

namespace App\Models;

use App\Traits\Attributes\HasIdentifier;
use App\Traits\HasBasicAudit;
use Illuminate\Database\Eloquent\Model;

class RoomSessionReservation extends Model
{
    /**
     * @use HasBasicAudit<App\Traits\Audit\HasBasicAudit> 
     * @use HasIdentifier<App\Traits\Attribute\HasIdentifier> 
     * @use HasRelationWithUserModel<App\Traits\Relation\HasRelationWithUserModel> 
     */
    use HasIdentifier,
        HasBasicAudit
    ;

    public const TABLE_NAME = "sipr_room_session_reservations";
    public const ROOM_RESERVATION_ID = "room_reservation_id";
    public const ROOM_SESSION_ID = "room_session_id";
    public const RESERVATION_DATE = "reservation_date";

    protected $table = self::TABLE_NAME;
    protected $primaryKey = self::ID;
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        self::ROOM_RESERVATION_ID,
        self::RESERVATION_DATE,
        self::ROOM_SESSION_ID,
        self::USER_ID,
        self::ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];
}
