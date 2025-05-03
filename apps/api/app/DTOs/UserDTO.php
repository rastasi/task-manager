<?php

namespace App\DTOs;

use App\Models\User;

class UserDTO {
  public function __construct(
      public ?string $name,
      public ?string $email,
      public ?int $id = null,
  ) {}

  public static function fromModel(User $user): self
  {
      return new self(
          name: $user->name,
          email: $user->email,
          id: $user->id,
      );
  }

  public function toArray(): array
  {
      return [
          'name' => $this->name,
          'email' => $this->email,
          'id' => $this->id,
      ];
  }
}
