<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'status',
        'type',
        'total_players',
        'winner',
        'created_by',
    ];
}
