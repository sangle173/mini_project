<?php

namespace App\Exports;

use App\Models\Board;
use App\Models\Priority;
use App\Models\Task;
use App\Models\Team;
use App\Models\TicketStatus;
use App\Models\Type;
use App\Models\User;
use App\Models\WorkingStatus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Row;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TasksWithCountExport implements FromCollection, WithHeadings, WithMapping, OnEachRow, ShouldAutoSize, WithStyles
{
    private $tasks;
    protected $index = 0;
    private $flag;

    function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->tasks;
    }


    public function headings(): array
    {
        return ['#', 'Board', 'Team', 'Type', 'Jira ID', 'Jira Summary', 'Working Status', 'Ticket Status', 'Link To Result', 'Test Plan', 'Sprint', 'Note', 'Priority', 'Pass TC', 'Fail TC', 'Total TC', 'Tester 1', 'Tester 2', 'Tester 3', 'Tester 4', 'Tester 5', 'Review Status', 'Review Content', 'Created at'];
    }


    public function bindValue(Cell $cell, $value)
    {
        // TODO: Implement bindValue() method.
    }

    public function map($row): array
    {
        return [
            ++$this->index,
            Board::find($row->board_id)->name,
            $row->team != null ? Team::find($row->team)->name : '',
            $row->type != null ? Type::find($row->type)->name : '',
            $row->jira_id,
            $row->jira_summary,
            $row->working_status != null ? WorkingStatus::find($row->working_status)->name : '',
            $row->ticket_status != null ? TicketStatus::find($row->ticket_status)->name : '',
            $row->link_to_result,
            $row->test_plan,
            $row->sprint,
            $row->note,
            $row->priority != null ? Priority::find($row->priority)->name : '',
            Task::getTotalTesCasePassByTaskId($row -> id),
            Task::getTotalTesCaseFailByTaskId($row -> id),
            Task::getTotalTesCasePassByTaskId($row -> id) + Task::getTotalTesCaseFailByTaskId($row -> id),
            $row->tester_1 != null ? User::find($row->tester_1)->name : '',
            $row->tester_2 != null ? User::find($row->tester_2)->name : '',
            $row->tester_3 != null ? User::find($row->tester_3)->name : '',
            $row->tester_4 != null ? User::find($row->tester_4)->name : '',
            $row->tester_5 != null ? User::find($row->tester_5)->name : '',
            $row->status != 0 ? 'Reviewed' : 'Not Yet',
            $row->review,
            $row->created_at,
        ];
    }

    public function onRow(Row $row)
    {
        // TODO: Implement onRow() method.
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],

//            // Styling a specific cell by coordinate.
//            'B2' => ['font' => ['italic' => true]],
//
//            // Styling an entire column.
//            'C'  => ['font' => ['size' => 16]],
        ];
    }
}
