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
    public const STATUS = "status";
    public const DETERMINED_AT = "determined_at";
    public const RESERVATION_DATE = "reservation_date";

    protected $table = self::TABLE_NAME;
    protected $primaryKey = self::ID;
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

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
}
