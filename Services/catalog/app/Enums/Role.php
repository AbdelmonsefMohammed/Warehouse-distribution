<?php

declare( strict_types = 1 );

namespace App\Enums;

enum Role: string
{
    case USER = 'user';

    case WAREHOUSE = 'warehouse';

    case MANAGER = 'manager';

    case ADMIN = 'admin';
}