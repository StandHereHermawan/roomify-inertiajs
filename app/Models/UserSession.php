<?php

namespace App\Models;

use App\Traits\Attributes\HasIdentifier;
use App\Traits\HasBasicAudit;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
        /**
     * @use HasBasicAudit<App\Traits\HasBasicAudit> 
     * @use HasIdentifier<App\Traits\Attributes\HasIdentifier> 
     */
    use HasIdentifier,
        HasBasicAudit;

    public const TABLE_NAME = 'sessions';
    public const USER_ID = 'user_id';
    public const IP_ADDRESS = 'ip_address';
    public const USER_AGENT = 'user_agent';
    public const PAYLOAD = 'payload';
    public const LAST_ACTIVITY = 'last_activity';

    protected $table = self::TABLE_NAME;
    protected $primaryKey = self::ID;

}
