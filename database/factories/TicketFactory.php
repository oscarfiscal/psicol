<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->uuid,
            'location' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 0, 100),
            'user_id' =>  User::factory()->create(),
            'event_id' =>  Event::factory()->create(),
        ];
    }
}
