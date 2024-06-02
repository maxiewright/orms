<?php

namespace Modules\Legal\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Legal\Enums\InterdictionStatus;
use Modules\Legal\Models\Incident;

class InterdictionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\Interdiction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'incident_id' => Incident::factory(),
            'requested_at' => fake()->dateTimeBetween('-30 days', 'now'),
            'interdicted_at' => null,
            'revoked_at' => null,
            'status' => InterdictionStatus::Pending,
            'particulars' => fake()->paragraph(),
        ];
    }

    public function interdicted(): self
    {
        $requestDate = fake()->dateTimeBetween('-60 days', '-10 day');
        $interdictionDate = fake()->dateTimeBetween($requestDate, 'now');

        return $this->state(fn (): array => [
            'requested_at' => $requestDate,
            'interdicted_at' => $interdictionDate,
            'status' => InterdictionStatus::Interdicted,
        ]);
    }

    public function revoked(): self
    {
        // interdicted at must be after requested_at
        $requestDate = fake()->dateTimeBetween('-60 days', '-10 days');
        $interdictionDate = fake()->dateTimeBetween($requestDate, '-5 days');
        $revocationDate = fake()->dateTimeBetween($interdictionDate);

        return $this->state(fn (): array => [
            'requested_at' => $requestDate,
            'interdicted_at' => $interdictionDate,
            'revoked_at' => $revocationDate,
            'status' => InterdictionStatus::Revoked,
        ]);
    }
}
