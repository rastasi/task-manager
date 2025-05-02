<?php

namespace App\DTOs;

class TaskDTO {
  public function __construct(
      public string $id,
      public string $title,
      public string $description,
      public bool $completed
  ) {}
}