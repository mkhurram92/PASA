<?php

namespace App\Helpers;

use App\Models\Gender;
use App\Models\Ports;
use App\Models\Ship;
use App\Models\States;
use App\Models\Title;

class Helper
{
    static function getState($state_id)
    {
        return States::whereId($state_id)->value('name');
    }

    static function getGender($gender_id)
    {
        return Gender::whereId($gender_id)->value('name');
    }

    static function getPlaceOfArrival($port_id)
    {
        return Ports::whereId($port_id)->value('name');
    }

    static function getNameofShip($ship_id)
    {
        return Ship::whereId($ship_id)->value('name_of_ship');
    }
    static function getTitle($title_id)
    {
        return Title::whereId($title_id)->value('name');
    }
}
