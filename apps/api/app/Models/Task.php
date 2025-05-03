<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $fillable = [
        "id",
        "description",
        "user_id",
        "estimated_time",
        "used_time",
        "completed_at"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
