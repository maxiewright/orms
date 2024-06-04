<?php

namespace Modules\Legal\Database\Factories\LegalAction;

use App\Models\Metadata\Contact\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class DefendantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\LegalAction\Defendant::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {

        $division = Division::all()->random()->id;
        $city = Division::find($division)->cities->random()->id;

        return [
            'name' => fake()->name(),
            'abbreviation' => fake()->slug(),
            'address_line_1' => fake()->streetAddress(),
            'address_line_2' => null,
            'division_id' => $division,
            'city_id' => $city,
            'particulars' => fake()->paragraph(),
        ];
    }
}
