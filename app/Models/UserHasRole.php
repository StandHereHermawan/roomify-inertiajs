<?php

namespace App\Models;

use App\Traits\Attributes\HasIdentifier;
use App\Traits\HasBasicAudit;
use App\Traits\Relation\HasRelationWithRoleModel;
use App\Traits\Relation\HasRelationWithUserModel;
use Illuminate\Database\Eloquent\Model;

class UserHasRole extends Model
{
    /**
     * @use HasBasicAudit<\App\Traits\HasBasicAudit> 
     * @use HasIdentifier<\App\Traits\Attributes\HasIdentifier> 
     * @use HasRelationWithUserModel<\App\Traits\Relation\HasRelationWithUserModel> 
     * @use HasRelationWithRoleModel<\App\Traits\Relation\HasRelationWithRoleModel> 
     * 
     */
    use
        HasIdentifier,
        HasRelationWithUserModel,
        HasRelationWithRoleModel,
        HasBasicAudit;

    public const TABLE_NAME = "sipr_user_has_roles";

    protected $table = self::TABLE_NAME;
    protected $primaryKey = self::ID;
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

    public function getSession()
    {
        return $this->session;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        self::ID,
        self::ROLE_ID,
        self::USER_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        // self::DELETED_AT,
    ];
}
