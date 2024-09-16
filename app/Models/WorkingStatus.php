<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WorkingStatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getWorkingStatusIdByBoardId($id, $name)
    {
        dd(DB::table('working_statuses') -> where('board_id',$id));
        return WorkingStatus::where('board_id', $id)->where('name', $name)->get()->id;
    }
}
