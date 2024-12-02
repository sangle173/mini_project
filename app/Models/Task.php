<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getTotalTesCasePassByTaskId($id){
        $task = Task::find($id);
        $task_with_duplicate_jira_id = Task::where('jira_id', $task -> jira_id) ->latest()->get();
        $total_tc_pass = 0;
        for ($i = 0; $i < $task_with_duplicate_jira_id->count(); $i++) {
            $total_tc_pass += $task_with_duplicate_jira_id[$i] -> pass;
        }  // end for
        return $total_tc_pass;
    }

    public static function getTotalTesCaseFailByTaskId($id){
        $task = Task::find($id);
        $task_with_duplicate_jira_id = Task::where('jira_id', $task -> jira_id) ->latest()->get();
        $total_tc_fail = 0;
        for ($i = 0; $i < $task_with_duplicate_jira_id->count(); $i++) {
            $total_tc_fail += $task_with_duplicate_jira_id[$i] -> fail;
        }  // end for
        return $total_tc_fail;
    }

    public static function getAllTaskWithSameJiraId($id){
        $task = Task::find($id);
        $task_with_duplicate_jira_id = Task::where('jira_id', $task -> jira_id) ->latest()->get();
        return $task_with_duplicate_jira_id;
    }
}
