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

    /**
     * Get users for register page. Only these types are users
     * are allowed to register through the register page. Others will
     * be created by admin
     */
    public static function getPublicUsers() :array
    {
        return array(
            4 => 'Customer',
            3 => 'Player',
            2 => 'Club Owner',
        );
    }

}
