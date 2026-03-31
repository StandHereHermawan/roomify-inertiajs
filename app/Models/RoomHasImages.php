<?php

namespace App\Models;

use App\Traits\Attributes\HasIdentifier;
use App\Traits\HasBasicAudit;
use Illuminate\Database\Eloquent\Model;

class RoomHasImages extends Model
{
    /**
     * @use HasBasicAudit<App\Traits\Audit\HasBasicAudit>
     * @use HasIdentifier<App\Traits\Attributes\HasIdentifier>
     * 
     */
    use HasBasicAudit,
        HasIdentifier;

    public const TABLE_NAME = "sipr_room_has_images";
    public const ROOM_ID = "room_id";
    public const IMAGE_ID = "image_id";

    protected $table = UserHasRole::TABLE_NAME;
    protected $primaryKey = self::ID;
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;
}
