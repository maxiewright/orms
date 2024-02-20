<?php

namespace Modules\ServiceFund\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ServiceFund\App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'website' => fake()->url(),
            'address_line_1' => fake()->streetAddress(),
            'address_line_2' => null,
            'city_id' => app(config('servicefund.address.city'))::all()->random()->id,
            'added_by' => auth()->id(),
            'is_active' => fake()->boolean(80),
        ];
    }
}
