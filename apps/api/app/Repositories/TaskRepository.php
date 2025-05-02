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

    public function create(TaskDTO $data)
    {
        return Task::create($data);
    }

    public function update(int $id, TaskDTO $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return true;
    }
}