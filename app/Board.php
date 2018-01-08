<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    function createBoard()
    {
        $numbers = range(0, 40);
        shuffle($numbers);
        $array = array_slice($numbers, 0, 8);
        $board = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

        for ($i = 0; $i < count($array); $i++) {
            $board[$i] = new Tile($array[$i]);
            $board[$i + 1] = new Tile($array[$i]);
        }
        shuffle($board);
        return $board;
    }

}
