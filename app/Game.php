<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'status',
        'type',
        'toral_players',
        'winner',
    ];
}
