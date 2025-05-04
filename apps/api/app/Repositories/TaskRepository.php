<?php

namespace App\Repositories;

use App\Models\Task;
use App\DTOs\TaskDTO;

class TaskRepository
{
    public function all(): array
    {
        $tasks = Task::with('user')->get();
        return $tasks->map(function (Task $task) {
            return TaskDTO::fromModel($task);
        })->toArray();
    }

    public function create(TaskDTO $task): TaskDTO
    {
        $task = Task::create($task->toArray());
        return TaskDTO::fromModel($task);
    }

    public function update(int $id, TaskDTO $task): TaskDTO
    {
        $record = Task::findOrFail($id);
        $data = array_filter($task->toArray(), fn($value) => !is_null($value));
        $record->update($data);
        return TaskDTO::fromModel($record);
    }

    public function destroy(int $id): bool
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return true;
    }
}