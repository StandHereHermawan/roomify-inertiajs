<?php

namespace App\Enums;

enum EnumsRoomReservationStatus : string
{
    case PENDING = 'PENDING';
    case REJECTED = 'REJECTED';
    case ACCEPTED = 'ACCEPTED';
}
