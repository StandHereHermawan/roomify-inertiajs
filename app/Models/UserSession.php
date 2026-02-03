<?php

namespace App\Models;

use App\Traits\Attributes\HasIdentifier;
use App\Traits\HasBasicAudit;
use App\Traits\Relation\HasRelationWithUserModel;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    /**
     * @use HasBasicAudit<App\Traits\HasBasicAudit> 
     * @use HasIdentifier<App\Traits\Attributes\HasIdentifier> 
     * @use HasRelationWithUserModel<\App\Traits\Relation\HasRelationWithUserModel> 
     * 
     */
    use HasIdentifier,
        HasBasicAudit,
        HasRelationWithUserModel;

    public const TABLE_NAME = 'sessions';
    public const IP_ADDRESS = 'ip_address';
    public const USER_AGENT = 'user_agent';
    public const PAYLOAD = 'payload';
    public const LAST_ACTIVITY = 'last_activity';

    protected $table = self::TABLE_NAME;
    protected $primaryKey = self::ID;

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
        self::ID,
        self::CREATED_AT,
        self::UPDATED_AT
    ];
}
