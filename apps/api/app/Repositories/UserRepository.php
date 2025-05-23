<?php

namespace App\Repositories;

use App\Models\User;
use App\DTOs\UserDTO;

class UserRepository
{
    public function all(): array
    {
        $users = User::all();
        return $users->map(function ($user) {
            return UserDTO::fromModel($user);
        })->toArray();
    }
}