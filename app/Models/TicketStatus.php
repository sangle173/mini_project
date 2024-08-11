<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    use HasFactory;
    use HasFactory;

    protected $guarded = [];

    public static function getBoardById($boardId){
        return Board::find($boardId);
    } // End Method
}
