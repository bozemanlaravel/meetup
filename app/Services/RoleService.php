<?php

namespace App\Services;

class RoleService
{
    public static function get()
    {
        return [
            1 => 'administrator',
            2 => 'organizer',
            3 => 'user',
        ];
    }

    public static function getName($id)
    {
        return self::get()[$id];
    }

    public static function getId($name)
    {
        return array_flip(self::get())[$name];
    }
}
