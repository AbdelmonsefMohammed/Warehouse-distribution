<?php

declare( strict_types = 1 );

namespace App\Enums;

enum WarehouseStatus: string
{
    case ONLINE = 'online';
    case FULL = 'full';
    case CLOSED = 'closed';
}