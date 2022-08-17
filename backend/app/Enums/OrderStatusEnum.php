<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

class OrderStatusEnum extends Enum
{
    private const PENDING = 'pending';
    private const FINISHED = 'finished';
    private const REJECTED = 'rejected';
}
