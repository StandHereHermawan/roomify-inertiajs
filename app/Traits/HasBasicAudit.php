<?php

namespace App\Traits;

trait HasBasicAudit
{
    public const CREATED_AT = "created_at";
    public const UPDATED_AT = "updated_at";

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
