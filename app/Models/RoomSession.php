<?php

namespace App\Models;

use App\Traits\Attributes\HasIdentifier;
use App\Traits\HasBasicAudit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomSession extends Model
{
    /**
     * @use HasBasicAudit<App\Traits\HasBasicAudit> 
     * @use HasIdentifier<App\Traits\Attributes\HasIdentifier> 
     * @use HasFactory<\Database\Factories\RoomSessionFactory>
     */
    use HasIdentifier,
        HasBasicAudit,
        HasFactory
    ;

    public const TABLE_NAME = 'sipr_room_sessions';
    public const SESSION_START = 'room_session_start';
    public const SESSION_END = 'room_session_end';

    protected $table = self::TABLE_NAME;
    protected $primaryKey = self::ID;
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        self::SESSION_START,
        self::SESSION_END,
    ];

    public function getRoomSessionStart()
    {
        return $this->room_session_start;
    }

    public function getRoomSessionEnd()
    {
        return $this->room_session_end;
    }
}
