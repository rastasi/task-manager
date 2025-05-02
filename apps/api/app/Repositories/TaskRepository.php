<?php

namespace App\Repositories;

use App\Models\Task;
use App\DTOs\TaskDTO;

class TaskRepository
{
    public function all()
    {
        return Task::all();
    }

    public function create(TaskDTO $task)
    {
        return Task::create([
            "description" => $task->description,
            "user_id" => $task->user_id,
            "estimated_time" => $task->estimated_time,
            "used_time" => $task->used_time
        ]);
    }

    public function update(int $id, TaskDTO $task)
    {
        $record = Task::findOrFail($id);
        $data = array_filter([
            "description" => $task->description,
            "user_id" => $task->user_id,
            "estimated_time" => $task->estimated_time,
            "used_time" => $task->used_time
        ], fn($value) => !is_null($value));
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