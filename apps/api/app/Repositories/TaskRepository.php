<?php

namespace App\Repositories;

use App\Models\Task;
use App\DTOs\TaskDTO;

class TaskRepository
{
    public function all()
    {
        $tasks = Task::with('user')->get();
        return $tasks->map(function ($task) {
            return TaskDTO::fromModel($task);
        });
    }

    public function create(TaskDTO $task)
    {
        $task = Task::create($task->toArray());
        return TaskDTO::fromModel($task);
    }

    public function update(int $id, TaskDTO $task)
    {
        $record = Task::findOrFail($id);
        $data = array_filter($task->toArray(), fn($value) => !is_null($value));
        $record->update($data);
        return $record;
    }

    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return true;
    }
}