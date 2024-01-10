<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sms>
 */
class SmsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => mt_rand(1, User::count()),
            "number" => format_phone(fake()->phoneNumber()),
            "message" => fake()->text(255),
            "send_time" => fake()->dateTime(),
            "status" => mt_rand(0, 3),
        ];
    }
}
