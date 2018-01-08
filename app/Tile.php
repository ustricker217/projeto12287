<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tile extends Model
{


    static function createTile($num)
    {
        $isHidden = true;
        $value = $num;
        $pathHidden = 'img/hidden.png';
        $pathTile = 'img/$value.png';

    }

}
