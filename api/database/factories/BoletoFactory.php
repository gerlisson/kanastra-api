<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Boleto>
 */
class BoletoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'governmentId' => $this->faker->randomNumber(6),
            'email' => $this->faker->safeEmail(),
            'debtAmount' => $this->faker->randomFloat('2',1,2000),
            'debtDueDate' => $this->faker->date(),
            'debtId' => $this->faker->uuid()
        ];
    }
}
