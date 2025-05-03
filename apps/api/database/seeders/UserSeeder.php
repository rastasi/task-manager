<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    for ($i = 1; $i <= 3; $i++) {
      $email = "test$i@example.com";

      if (!User::where('email', $email)->exists()) {
        User::factory()->create([
          'name' => "Test User #$i",
          'email' => $email,
        ]);
      }
    }
  }
}
