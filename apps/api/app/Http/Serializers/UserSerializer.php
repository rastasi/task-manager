<?php

namespace App\Http\Serializers;

use App\DTOs\UserDTO;

class UserSerializer
{
    public static function serialize(UserDTO $dto): array
    {
        return [
            'id' => $dto->id,
            'name' => $dto->name,
            'email' => $dto->email,
        ];
    }

    public static function serializeMany(array $dtos): array
    {
        return array_map(fn(UserDTO $dto) => self::serialize($dto), $dtos);
    }
}