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

    public function index(): array
    {
        return $this->taskRepository->all();
    }

    public function store(TaskDTO $task): TaskDTO
    {
        return $this->taskRepository->create($task);
    }

    public function update(int $id, TaskDTO $task): TaskDTO
    {
        return $this->taskRepository->update($id, $task);
    }

    public function destroy(int $id): bool
    {
        return $this->taskRepository->destroy($id);
    }
}