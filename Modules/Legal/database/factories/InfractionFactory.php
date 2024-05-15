<?php

namespace Modules\Legal\Database\Factories;

use App\Models\Metadata\Contact\Division;
use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Legal\Enums\IncidentStatus;

class InfractionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\Incident::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $division = Division::all()->random()->id;
        $city = Division::find($division)->cities->random()->id;

        return [
            'serviceperson_number' => Serviceperson::factory()->enlisted(),
            'occurred_at' => fake()->dateTime(),
            'address_line_1' => fake()->address(),
            'address_line_2' => fake()->streetAddress(),
            'division_id' => $division,
            'city_id' => $city,
            'status' => fake()->randomElement(IncidentStatus::cases()),
            'particulars' => fake()->sentence(),
        ];
    }
}
