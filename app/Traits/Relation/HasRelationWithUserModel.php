<?php

namespace App\Traits\Relation;

use App\Models\User;

trait HasRelationWithUserModel
{
    public const USER_ID = "user_id";

    public function getUserId()
    {
        return $this->user_id;
    }

    public function user()
    {
        // Satu comment dimiliki oleh satu post
        return $this->belongsTo(User::class);
    }
}
