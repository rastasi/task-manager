<?php

namespace App\DTOs;

use App\Models\Task;
use App\Models\User;


class TaskDTO {
  public function __construct(
      public ?string $description,
      public ?int $user_id,
      public ?int $estimated_time,
      public ?int $used_time = 0,
      public ?int $id = null,
      public ?int $completed_at = null,
      public ?UserDTO $user = null
  ) {}

  public static function fromModel(Task $task): self
  {
      return new self(
          description: $task->description,
          user_id: $task->user_id,
          user: $task->user ? UserDTO::fromModel($task->user) : null,
          estimated_time: $task->estimated_time,
          used_time: $task->used_time,
          id: $task->id,
          completed_at: $task->completed_at,
      );
  }

  public function toArray(): array
  {
      return [
          'description' => $this->description,
          'user_id' => $this->user_id,
          'user' => $this->user?->toArray(),
          'estimated_time' => $this->estimated_time,
          'used_time' => $this->used_time,
          'id' => $this->id,
          'completed_at' => $this->completed_at,
      ];
  }
}