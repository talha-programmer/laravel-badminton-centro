<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const Pending = 0;
    const Confirmed =  1;
    const Delivered = 2;
}
