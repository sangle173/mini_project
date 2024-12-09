<?php

namespace App\Imports;

use App\Models\Task;
use App\Models\Team;
use App\Models\TicketStatus;
use App\Models\Type;
use App\Models\User;
use App\Models\WorkingStatus;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class TaskImport implements WithStartRow, WithValidation, OnEachRow
{
//    /**
//    * @param array $row
//    *
//    * @return \Illuminate\Database\Eloquent\Model|null
//    */
//    public function model(array $row)
//    {
////        dd($row);
//        return new User([
//            'name'     => $row[0],
//            'username'    => $row[1],
//            'email'    => $row[2],
//            'password'    => '123456',
//            'phone'    => $row[3],
//            'address'    => $row[4],
//        ]);
//    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '1' => 'unique:users,email'
        ];
    }

    public function customValidationMessages()
    {
        return [
            '1.unique' => 'Demo',
        ];
    }

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();
        $created_at = Carbon::parse($row[0])->format('Y-m-d');
        $team = Team::where('name', substr($row[1], 4))->first()->id;
        $type = null;
        switch ($row[2]) {
            case 'Testing request':
                $type = 2;
                break;
            case 'Bug found':
                $type = 1;
                break;
            case 'Ticket verification':
                $type = 3;
                break;
            default:
                $type = null;

        }
        $working_status = null;

        switch ($row[5]) {
            case 'In-progress':
                $working_status = 1;
                break;
            case 'Open':
                $working_status = 2;
                break;
            case 'Done':
                $working_status = 2;
                break;
            default:
                $working_status = null;

        }

        $ticket_status = null;
        switch ($row[6]) {
            case 'RESOLVED':
                $ticket_status = 3;
                break;
            case 'CLOSED':
                $ticket_status = 2;
                break;
            case 'REOPENED':
                $ticket_status = 7;
                break;
            case 'IN PROGRESS':
                $ticket_status = 1;
                break;
            case 'OPEN':
                $ticket_status = 9;
                break;
            case 'BLOCKED':
                $ticket_status = 6;
                break;
            case 'READY TO VERIFY':
                $ticket_status = 5;
                break;
            case 'IN VERIFICATION':
                $ticket_status = 4;
                break;
            case 'IN-REVIEW':
                $ticket_status = 10;
                break;
            case 'TESTING':
                $ticket_status = 11;
                break;
            case 'WAITING FOR PARTNER':
                $ticket_status = 12;
                break;
            case 'DONE':
                $ticket_status = 13;
                break;
            default:
                $ticket_status = null;

        }
        $task = Task::create([
            'board_id'=> 1,
            'created_at' => $created_at,
            'team' => $team,
            'type' => $type,
            'jira_id' => $row[3],
            'jira_summary' => $row[4],
            'working_status' => $working_status,
            'ticket_status' => $ticket_status,
            'tester_1' => $row[7] != null ? User::where('name', substr($row[7], 7))->first()->id : null,
            'tester_2' => $row[8] != null ? User::where('name', substr($row[8], 7))->first()->id : null,
            'tester_3' => $row[9] != null ? User::where('name', substr($row[9], 7))->first()->id : null,
            'tester_4' => $row[10] != null ? User::where('name', substr($row[10], 7))->first()->id : null,
            'tester_5' => $row[11] != null ? User::where('name', substr($row[11], 7))->first()->id : null
        ]);
//        dd($task);

//        if ($row[6]){
//            $course = Course::where('course_name', $row[6])->pluck('id');
//            $user->pluck('id');
//            $order = new Order();
//            $order->payment_id = 1;
//            $order->user_id = $user -> id;
//            $order->course_id = $course -> first();
//            $order->instructor_id = Auth::user()->id;
//            $order->save();
//        }
//        if ($row[7]){
//            $course = Course::where('course_name', $row[7])->pluck('id');
//            $user->pluck('id');
//            $order = new Order();
//            $order->payment_id = 1;
//            $order->user_id = $user -> id;
//            $order->course_id = $course -> first();
//            $order->instructor_id = Auth::user()->id;
//            $order->save();
//        }
//
//        if ($row[8]){
//            $course = Course::where('course_name', $row[8])->pluck('id');
//            $user->pluck('id');
//            $order = new Order();
//            $order->payment_id = 1;
//            $order->user_id = $user -> id;
//            $order->course_id = $course -> first();
//            $order->instructor_id = Auth::user()->id;
//            $order->save();
//        }
    }
}
