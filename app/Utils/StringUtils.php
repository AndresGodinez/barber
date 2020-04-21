<?php

namespace App\Utils;

use Str;

class StringUtils{

    public static function getUserName(string $name, string $lastName):string
    {
        $name = Str::ucfirst($name);
        $lastName = Str::ucfirst($lastName);

        $firstLetter = substr($name, 0, 1);
        return $firstLetter.$lastName;
    }

    public static function getFullName(string $name, string $lastName):string
    {
        return $name.' '.$lastName;
    }

}