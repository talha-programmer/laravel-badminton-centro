<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserTypes extends Enum
{
    const Admin =   0;
    const Director =   1;
    const ClubOwner = 2;
    const Player = 3;
    const Customer = 4;

}
