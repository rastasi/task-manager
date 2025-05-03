<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use App\DTOs\TaskDTO;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {
        return $this->taskRepository->all();
    }

    public function store(TaskDTO $task)
    {
        return $this->taskRepository->create($task);
    }

    public function update(int $id, TaskDTO $task)
    {
        return $this->taskRepository->update($id, $task);
    }

    public function destroy(int $id)
    {
        $this->taskRepository->destroy($id);
    }
}