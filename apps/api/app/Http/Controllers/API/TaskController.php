<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\DTOs\TaskDTO;
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
        return response()->json(['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $data = $this->taskService->store(new TaskDTO());
        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $this->taskService->update($id, new TaskDTO());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = $this->taskService->destroy($id);
        return response()->json($data);
    }
}