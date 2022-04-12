<?php

namespace App\Service;

class Filter
{
    private static $location = [
        'Lodz',
        'New York',
        'Kyiv',
        'London',
        'Roma',
        'Stockholm',
        'Lviv',
    ];
    
    public static function getLocation(): array {
        return self::$location;
    } 
}