<?php

namespace Modules\ServiceFund\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ServiceFund\App\Models\TransactionCategory;

class TransactionCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = TransactionCategory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'description' => fake()->text,
        ];
    }

    public function hasParent(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_id' => TransactionCategory::factory(),
            ];
        });
    }
}

