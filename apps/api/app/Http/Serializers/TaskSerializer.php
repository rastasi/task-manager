<?php

namespace App\Http\Serializers;

use App\DTOs\TaskDTO;

class TaskSerializer
{
    public static function serialize(TaskDTO $dto): array
    {
        return [
            'id' => $dto->id,
            'description' => $dto->description,
            'userId' => $dto->user_id,
            'estimatedTime' => $dto->estimated_time,
            'usedTime' => $dto->used_time,
            'completedAt' => $dto->completed_at,
            'user' => $dto->user ? UserSerializer::serialize($dto->user) : null,
        ];
    }

    public static function serializeMany(array $dtos): array
    {
        return array_map(fn(TaskDTO $dto) => self::serialize($dto), $dtos);
    }
}