<?php

namespace App\Enums;

enum EnumsRole: string
{
    case SUPER_ADMIN = 'SUPER_ADMIN';
    case ADMIN = 'ADMIN';
    case VISITOR = 'VISITOR';
}
