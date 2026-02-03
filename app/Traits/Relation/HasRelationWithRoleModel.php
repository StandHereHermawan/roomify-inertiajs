<?php

namespace App\Traits\Relation;

trait HasRelationWithRoleModel
{
    public const ROLE_ID = "role_id";

    public function getRoleId()
    {
        return $this->role_id;
    }
}
