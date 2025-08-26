<?php

namespace App\Models;

use App\Traits\Attributes\HasIdentifier;
use App\Traits\HasBasicAudit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * @use HasFactory<\Database\Factories\RoomFactory>
     * @use HasBasicAudit<App\Traits\Audit\HasBasicAudit>
     * @use HasIdentifier<App\Traits\Attribute\HasIdentifier>
     * 
     */
    use HasBasicAudit,
        HasFactory,
        HasIdentifier;

    public const TABLE_NAME = 'sipr_rooms';
    public const NAME = 'name';
    public const CODE = 'room_code';
    public const DESCRIPTION = 'description';
    public const HEIGHT_IN_METER = 'height_in_meter';
    public const FLOOR_WIDE_IN_METER_SQUARED = 'floor_wide_in_meter_squared';

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
        self::NAME,
        self::CODE,
        self::DESCRIPTION,
        self::HEIGHT_IN_METER,
        self::FLOOR_WIDE_IN_METER_SQUARED,
        self::ID,
        self::CREATED_AT,
        self::UPDATED_AT
    ];
}
