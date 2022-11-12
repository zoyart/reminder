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
            'next_iteration' => date('Y-m-d'),
        ]);

        return back();
    }

    public function deleteTask(Request $request) {
        Task::destroy($request->task_id);

        return back();
    }

    public function completeTask(Request $request) {
        switch ($request->current_phase) {
            case 1:
                $nextIteration = date_modify($request->currentIteration, "+1 day");
                break;
            case 2:
                $nextIteration = date_modify($request->currentIteration, "+2 day");
                break;
            case 3:
                $nextIteration = date_modify($request->currentIteration, "+5 day");
                break;
            case 4:
                $nextIteration = date_modify($request->currentIteration, "+7 day");
                break;
        }

        Task::find($request->task_id)->update([
            'phase' => $request->current_phase + 1,
            'next_iteration' => $nextIteration,
        ]);

        return back();
    }
}
