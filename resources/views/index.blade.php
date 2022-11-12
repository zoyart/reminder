@extends('layouts.layout')

@section('title')
    Reminder
@endsection

@section('main')
    <div class="container h-100">
        <div class="boards my-4 d-flex">
            <!-- Button trigger modal -->
            <button type="button" class="btn c-btn-board rounded-1 px-4 py-2 me-3" data-bs-toggle="modal"
                    data-bs-target="#add_board">
                Add board
            </button>
            <!-- Modal add board-->
            <div class="modal fade" id="add_board" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('createBoard') }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add board</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                       autocomplete="off"
                                       aria-describedby="emailHelp">
                            </div>
                            <div class="modal-footer d-flex justify-content-start">
                                <button type="submit" class="btn c-btn-board rounded-1 me-3">Add</button>
                                <button type="button" class="btn btn-outline-dark rounded-1" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @foreach($boards as $board)
                <button class="btn c-btn-board rounded-1 px-4 py-2 me-3 board-btn" id="" type="button"
                        data-bs-toggle="collapse" data-bs-target="#board-{{ $board['id'] }}" aria-expanded="false"
                        aria-controls="{{ $board['id'] }}">
                    {{ $board['name'] }}
                </button>
            @endforeach
        </div>
        @foreach($boards as $board)
            <div class="collapse" id="board-{{ $board->id }}">
                <div class="d-flex align-items-center mb-2">
                    <div class="h2 mb-0 me-3">{{ $board->name }}</div>
                    <button class="btn p-1 rounded-1 me-3 board-btn c-btn-board btn-more" id="" type="button"
                            data-bs-toggle="collapse" data-bs-target="#board-settings-{{ $board->id }}"
                            aria-expanded="false"
                            aria-controls="board-settings-{{ $board->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                            <path
                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                        </svg>
                    </button>
                    <div class="collapse" id="board-settings-{{ $board->id }}">
                        <div class="d-flex">
                            <button type="button" class="btn btn-outline-orange-c rounded-1 py-0 me-2"
                                    data-bs-toggle="modal" data-bs-target="#add_task">
                                Create task
                            </button>
                            <!-- Modal create task -->
                            <div class="modal fade" id="add_task" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('createTask') }}" method="post">
                                            @csrf
                                            <input type="text" name="board_id" value="{{ $board->id }}"
                                                   style="display: none">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add task</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3 row">
                                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="title"
                                                               placeholder="Read the lecture" name="title">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="text" class="col-sm-2 col-form-label">Text</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="text"
                                                               placeholder="Repeat 10 pages" name="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-start">
                                                <button type="submit" class="btn c-btn-board rounded-1 me-3">Add
                                                </button>
                                                <button type="button" class="btn btn-outline-dark rounded-1"
                                                        data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-orange-c rounded-1 py-0 me-2">
                                Edit
                            </button>
                            <form action="{{ route('deleteBoard') }}" method="post">
                                @method('DELETE')
                                @csrf
                                <input type="text" name="board_id" value="{{ $board->id }}"
                                       style="display: none">
                                <button type="submit" class="btn btn-outline-danger-c rounded-1 py-0 me-2">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @if($board->tasks)
                    @foreach($board->tasks as $task)
                        <div class="cards d-flex flex-wrap">
                            <div
                                class="card card-gradient border border-c-gray rounded-1 p-3 d-flex flex-column mb-4 me-4"
                                style="min-height:200px; height: auto; width: 400px">
                                <span class="h5">
                                    {{ $task['title'] }}
                                </span>
                                <span class="flex-grow-1 text-secondary">
                                    {{ $task['text'] }}
                                </span>
                                <div class="d-flex justify-content-between text-secondary">
                                    <button class="btn px-3 py-0 rounded-1 me-3 board-btn c-btn-board btn-more" id=""
                                            type="button"
                                            data-bs-toggle="collapse" data-bs-target="#task-action-{{ $task['id'] }}"
                                            aria-expanded="false" aria-controls="#task-action-{{ $task['id'] }} ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                            <path
                                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                        </svg>
                                    </button>
                                    <span>Next repeat {{ $task['next_iteration'] }}</span>
                                    <span>{{ $task['phase'] }} of 5</span>
                                </div>
                                <div class="collapse" id="task-action-{{ $task['id'] }}">
                                    <div class="actions mt-3 d-flex">
                                        <button type="button" class="btn c-btn-board rounded-1 me-3 py-0">Complete!
                                        </button>
                                        <button type="button" class="btn c-btn-board rounded-1 me-3 py-0">Edit</button>
                                        <form action="{{ route('deleteTask') }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input type="text" name="task_id" value="{{ $task['id'] }}"
                                                   style="display: none">
                                            <button type="submit" class="btn c-btn-board rounded-1 me-3 py-0">Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>
@endsection

