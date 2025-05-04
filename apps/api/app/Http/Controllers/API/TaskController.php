<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\DTOs\TaskDTO;
use App\Http\Serializers\TaskSerializer;
use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->index();
        return response()->json(TaskSerializer::serializeMany($tasks));
    }

    public function store(Request $request)
    {
        $task = $this->taskService->store(new TaskDTO(
            description: $request->input("description"),
            user_id: $request->input("userId"),
            estimated_time: $request->input("estimatedTime"),
            used_time: $request->input("usedTime"),
        ));
        return response()->json(TaskSerializer::serialize($task), 201);
    }

    public function update(Request $request, $id)
    {
        $task = $this->taskService->update($id, new TaskDTO(
            description: $request->input("description"),
            user_id: $request->input("userId"),
            estimated_time: $request->input("estimatedTime"),
            used_time: $request->input("usedTime"),
            completed_at: $request->input("completedAt"),
        ));
        return response()->json(TaskSerializer::serialize($task));
    }

    public function destroy($id)
    {
        $success = $this->taskService->destroy($id);
        return response()->json(["success" => $success]);
    }
}