<?php

namespace App\Models;

use App\Traits\Attributes\HasIdentifier;
use App\Traits\HasBasicAudit;
use App\Traits\Relation\HasRelationWithUserModel;
use Illuminate\Database\Eloquent\Model;

class AuthenticationSession extends Model
{
    /**
     * @use HasBasicAudit<App\Traits\HasBasicAudit> 
     * @use HasRelationWithUserModel<\App\Traits\Relation\HasRelationWithUserModel> 
     * 
     */
    use HasIdentifier,
        HasRelationWithUserModel;

    public const TABLE_NAME = 'sessions';
    public const IP_ADDRESS = 'ip_address';
    public const USER_AGENT = 'user_agent';
    public const PAYLOAD = 'payload';
    public const LAST_ACTIVITY = 'last_activity';

    protected $table = self::TABLE_NAME;
    protected $primaryKey = self::ID;
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        self::IP_ADDRESS,
        self::USER_AGENT,
        self::PAYLOAD,
        self::LAST_ACTIVITY,
        self::USER_ID,
        self::ID,
    ];
}
