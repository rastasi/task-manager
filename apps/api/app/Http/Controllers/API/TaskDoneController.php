<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\DTOs\TaskDTO;
use App\Http\Serializers\TaskSerializer;
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
        $taskDTO = new TaskDTO();
        $taskDTO->completed_at = Carbon::now()->toDateTimeString();
        $task = $this->taskService->update($id, $taskDTO);
        return response()->json(TaskSerializer::serialize($task));
    }
}