<?php

namespace App\Traits\Attributes;

trait HasIdentifier
{
    public const ID = "id";

    public function getId()
    {
        return $this->id;
    }
}
