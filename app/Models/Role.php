<?php

namespace App\Models;

use App\Traits\Attributes\HasIdentifier;
use App\Traits\HasBasicAudit;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * @use HasBasicAudit<\App\Traits\HasBasicAudit> 
     * @use HasIdentifier<\App\Traits\Attributes\HasIdentifier> 
     * 
     */
    use
        // HasFactory,
        // SoftDeletes,
        HasIdentifier,
        HasBasicAudit;

    public const TABLE_NAME = "sipr_roles";
    public const NAME = 'role';
    // public const DELETED_AT = "deleted_at";

    protected $table = Role::TABLE_NAME;
    protected $primaryKey = self::ID;
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        self::ID,
        self::NAME,
        self::CREATED_AT,
        self::UPDATED_AT,
        // self::DELETED_AT,
    ];
}
