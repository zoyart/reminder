<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TasksController extends Controller
{
    public function index() {
        $boards = Board::all();
        $tasks = Task::all();

        return view('index', ['boards' => $boards, 'tasks' => $tasks,]);
    }

    public function createBoard(Request $request) {
        Board::create([
            'name' => $request->name,
        ]);

        return back();
    }

    public function deleteBoard(Request $request) {
        Task::where('board_id', $request->board_id)->delete();
        Board::destroy($request->board_id);

        return back();
    }

    public function createTask(Request $request) {
        Task::create([
            'title' => $request->title,
            'text' => $request->text,
            'board_id' => $request->board_id,
            'phase' => 1,
            'repeat_date' => date('Y-m-d'),
        ]);

        return back();
    }

    public function deleteTask(Request $request) {
        Task::destroy($request->task_id);

        return back();
    }

    public function completeTask(Request $request) {
        // Создание объекта для функции date_modify
        $repeatDate = date_create($request->repeat_date);
        $task = Task::find($request->task_id);

        switch ($request->phase) {
            case 1:
                $repeatDate = date_modify($repeatDate, "+1 day");
                break;
            case 2:
                $repeatDate = date_modify($repeatDate, "+3 day");
                break;
            case 3:
                $repeatDate = date_modify($repeatDate, "+5 day");
                break;
            case 4:
                $repeatDate = date_modify($repeatDate, "+14 day");
                break;
            case 5:
                Task::find($request->task_id)->delete();
                break;
        }
        
        if (isset($task)) {
            $task->update([
                'phase' => $request->phase + 1,
                'repeat_date' => $repeatDate,
            ]);
        }

        return back();
    }
}
