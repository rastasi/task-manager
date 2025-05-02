<?php

namespace App\DTOs;

class TaskDTO {
  public function __construct(
      public ?string $description,
      public ?int $user_id,
      public ?int $estimated_time,
      public ?int $used_time = 0,
      public ?int $id = null,
      public ?int $completed_at = null
  ) {}
}