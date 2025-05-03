<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\DTOs\TaskDTO;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Carbon\Carbon;

class TaskDoneController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(Request $request, $id)
    {
        $task = new TaskDTO();
        $task->completed_at = Carbon::now()->toDateTimeString();
        $data = $this->taskService->update($id, $task);
        return response()->json($data);
    }
}